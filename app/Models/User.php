<?php

namespace App\Models;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;  // Menambahka ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Guru;

class User extends Authenticatable implements JWTSubject // Menambahkan "implements JWTSubject"
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username', // tambahan
        'email',
        'password',
        'type' // tambahan
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi One-To-One ke tabel guru
    public function guru()
    {
        return $this->hasOne(Guru::class, 'user_id', 'id');
    }

    /**
     * Mengambil identifier unik yang akan disimpan di 'sub' (subject) claim JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Menambahkan payload custom ke dalam token.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
