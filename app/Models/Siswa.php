<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $fillable = [ 'nis','gender','nama','tempat_lahir','tgl_lahir',
                            'nama_ortu','phone_number','email','alamat','kelas_id'
                        ];
    protected $casts = ['tgl_lahir'];
    public function kelas()
    {
    return $this->belongsTo('App\Models\Kelas','kelas_id');
    }
}
