<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaResource extends BaseResource
{

    public function getModel() {
        return Siswa::class;
    }

    // Untuk filter 'q'
    public function getGlobalSearchColumns()
    {
    return ['nis', 'nama', 'gender', 'kelas_id', 'tempat_lahir'];
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'href'  =>  route('siswa.show', $this->id),
            'data'  => [
                ['name' =>  'id',           'value' => $this->id,               'prompt'    => 'ID'],
                ['name' =>  'nis',          'value' => $this->nis,              'prompt'    => 'Nomor Induk Siswa'],
                ['name' =>  'gender',       'value' => $this->gender,           'prompt'    => 'Jenis Kelamin'],
                ['name' =>  'nama',         'value' => $this->nama,             'prompt'    => 'Nama Lengkap'],
                ['name' =>  'tempat_lahir', 'value' => $this->tempat_lahir,     'prompt'    => 'Tempat Lahir'],
                ['name' =>  'tgl_lahir',    'value' => $this->tgl_lahir,        'prompt'    => 'Tanggal Lahir'],
                ['name' =>  'nama_ortu',    'value' => $this->nama_ortu,        'prompt'    => 'Nama Orang Tua'],
                ['name' =>  'phone_number', 'value' => $this->phone_number,     'prompt'    => 'Nomor Telepon'],
                ['name' =>  'email',        'value' => $this->email,            'prompt'    => 'Email'],
                ['name' =>  'alamat',       'value' => $this->alamat,           'prompt'    => 'Alamat'],
                ['name' =>  'kelas_id',     'value' => $this->kelas_id,         'prompt'    => 'ID kelas'],
            ],

            '_links'          => [
                [
                    'rel'   => 'self',
                    'method'=> 'GET',
                    'href'  =>  route('siswa.show', $this->id),
                    'prompt'    =>  'Detail Siswa'
                ],
                [
                    'rel'   => 'index',
                    'method'=> 'GET',
                    'href'  =>  route('siswa.index'),
                    'prompt'    =>  'Dafar Siswa'
                ],
                [
                    'rel'   => 'update',
                    'method'=> 'PUT',
                    'href'  =>  route('siswa.update', $this->id),
                    'prompt'    =>  'Update Data Siswa'
                ],
                [
                    'rel'   => 'delete',
                    'method'=> 'DELETE',
                    'href'  =>  route('siswa.destroy', $this->id),
                    'prompt'    =>  'Hapus Data Siswa'
                ]
            ]
        ];
    }

    # Template untuk template
    public function getTemplateData()
    {
        return [
            ['name' => 'nis', 'value' => '', 'prompt' => 'NIS'],
            ['name' => 'nama', 'value' => '',  'prompt' => 'Nama lengkap'],
            [
                'name' => 'gender',
                'value' => '',
                'prompt' => 'Jenis kelamin',
                'options' => [
                    ['value' => 'laki-laki', 'prompt' => 'Laki-laki'],
                    ['value' => 'perempuan', 'prompt' => 'Perempuan']
                ]
            ],
            ['name' => 'tempat_lahir', 'value' => '', 'prompt' => 'Tempat Lahir'],
            ['name' => 'tgl_lahir', 'value' => '', 'prompt' => 'Tanggal Lahir'],
            ['name' => 'email', 'value' => '', 'prompt' => 'Email'],
            ['name' => 'alamat', 'value' => '', 'prompt' => 'Alamat'],
            ['name' => 'phone_number', 'value' => '', 'prompt' => 'Nomor Telepone'],
            ['name' => 'nama_ortu', 'value' => '', 'prompt' => 'Nama Orang Tua'],
            [
                'name' => 'kelas_id',
                'value' => '',
                'prompt' => 'ID Kelas',
                'options' => Kelas::select('id', 'nama_kelas')->get()->map(fn($k) => [
                    'value' => $k->id, 'prompt' => $k->nama_kelas
                ])
            ],
        ];
    }

    # Template untuk queries
    public function getFilterDefinitions()
    {
    return [
            [
                'name'   => 'nis',
                'value' => '',
                'prompt' => 'Filter berdasarkan NIS'
            ],
            [
                'name'   => 'nama',
                'value' => '',
                'prompt' => 'Filter berdasarkan nama siswa'
            ],
            [
                'name'   => 'gender',
                'value' => '',
                'prompt' => 'Filter berdasarkan jenis kelamin',
                'options' =>
                    [
                        ['value' => 'laki-laki', 'prompt' => 'Laki-laki'],
                        ['value' => 'perempuan', 'prompt' => 'Perempuan'],
                    ]
            ],
            [
                'name'   => 'kelas_id',
                'value' => '',
                'prompt' => 'Filter berdasarkan ID Kelas',
                'options' => Kelas::select('id', 'nama_kelas')->get()->map(fn($kelas) => [
                        'value' => $kelas->id,
                        'prompt' => $kelas->nama_kelas
                ])
            ],
            [
                'name'   => 'tempat_lahir',
                'value' => '',
                'prompt' => 'Cari berdasarkan tempat lahir'
            ],
            [
                'name'   => 'q',
                'value' => '',
                'prompt' => 'Pencarian umum'
            ],
        ];
    }
}
