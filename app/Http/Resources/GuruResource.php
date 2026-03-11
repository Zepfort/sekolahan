<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Guru;

class GuruResource extends BaseResource
{
    public function getModel() {
        return Guru::class;
    }

    public function getGlobalSearchColumns()
    {
    // Untuk filter 'q'
    return ['nip', 'nama', 'gender', 'pendidikan'];
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'href' => route('guru.show', $this->id),
            'data' => [
                ['name' => 'id',            'value' => $this->id,              'prompt' => 'ID'],
                ['name' => 'user_id',       'value' => $this->user_id,         'prompt' => 'ID User'],
                ['name' => 'nip',           'value' => $this->nip,             'prompt' => 'Nomor Induk Pegawai'],
                ['name' => 'nama',          'value' => $this->nama,            'prompt' => 'Nama Lengkap'],
                ['name' => 'tempat_lahir',  'value' => $this->tempat_lahir,    'prompt' => 'Tempat Lahir'],
                ['name' => 'tgl_lahir',     'value' => $this->tgl_lahir,       'prompt' => 'Tanggal Lahir'],
                ['name' => 'email',         'value' => $this->email,           'prompt' => 'Email'],
                ['name' => 'alamat',        'value' => $this->alamat,          'prompt' => 'Alamat'],
                ['name' => 'gender',        'value' => $this->gender,          'prompt' => 'Jenis Kelamin'],
                ['name' => 'phone_number',  'value' => $this->phone_number,    'prompt' => 'Nomor Telepon'],
                ['name' => 'pendidikan',    'value' => $this->pendidikan,      'prompt' => 'Pendidikan'],
            ],

            // HATEOAS
            '_links' => [
                [
                    'rel'    => 'self',
                    'method' => 'GET',
                    'href'   => route('guru.show', $this->id),
                    'prompt'    =>  'Detail Data Guru',
                ],
                [
                    'rel'    => 'account_details', // Link ke data User (akun)
                    'method' => 'GET',
                    'href'   => route('users.show', $this->user_id),
                    'prompt'    =>  'Detail User Pada Guru',
                ],
                [
                    'rel'    => 'index',
                    'method' => 'GET',
                    'href'   => route('guru.index'),
                    'prompt'    =>  'Daftar Guru',
                ],
                [
                    'rel'    => 'update',
                    'method' => 'PUT',
                    'href'   => route('guru.update', $this->id),
                    'prompt'    =>  'Update Data Guru',
                ],
                [
                    'rel'    => 'delete',
                    'method' => 'DELETE',
                    'href'   => route('guru.destroy', $this->id),
                    'prompt'    =>  'Hapus Data Guru',
                ],
            ]
        ];
    }

    # Template untuk template
    public function getTemplateData()
    {
        return [
            ['name' => 'user_id', 'value' => '', 'prompt' => 'ID User'],
            ['name' => 'nip', 'value' => '','prompt' => 'NIP'],
            ['name' => 'name', 'value' => '','prompt' => 'Nama Lengkap'],
            ['name' => 'tempat_lahir', 'value' => '','prompt' => 'Tempat Lahir'],
            ['name' => 'tgl_lahir', 'value' => '','prompt' => 'Tanggal Lahir'],
            [
                'name' => 'gender',
                'value' => '',
                'prompt' => 'Jenis Kelamin',
                'options' => [
                    ['value' => 'laki-laki', 'prompt' => 'Laki-laki'],
                    ['value' => 'perempuan', 'prompt' => 'Perempuan']
                ]
            ],
            ['name' => 'phone_number', 'value' => '','prompt' => 'Nomor Telepone'],
            ['name' => 'email', 'value' => '','prompt' => 'Email'],
            ['name' => 'alamat', 'value' => '','prompt' => 'Alamat'],
            ['name' => 'pendidikan', 'value' => '','prompt' => 'Pendidikan Terakhir'],
        ];
    }

    # Template untuk queries
    public function getFilterDefinitions()
    {
    return [
            [
                'name'   => 'nip',
                'value' => '',
                'prompt' => 'Cari berdasarkan NIP'
            ],
            [
                'name'   => 'nama',
                'value' => '',
                'prompt' => 'Filter berdasarkan nama guru'
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
                'name'   => 'pendidikan',
                'value' => '',
                'prompt' => 'Filter berdasarkan pendidikan terakhir'
            ],
            [
                'name'   => 'q',
                'value' => '',
                'prompt' => 'Pencarian umum '
            ],
        ];
    }
}
