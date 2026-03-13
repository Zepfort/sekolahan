<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $fillable = [
                        'user_id','nip','nama','tempat_lahir','tgl_lahir','gender','phone_number',
                        'email','alamat','pendidikan'
                        ];

    protected $casts = ['tgl_lahir'];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function jadwals()
    {
        return $this->hasMany('App\Models\Jadwal', 'guru_id');
    }
}
