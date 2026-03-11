<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends BaseResource
{

    public function getModel() {
        return \App\Models\User::class;
    }

    // Untuk filter 'q'
    public function getGlobalSearchColumns()
    {
    return ['username', 'name', 'type'];
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $res = [
            'href'  => route('users.show', $this->id),
            'data'  => [
                ['name' => 'id',        'value' => $this->id,       'prompt'    =>  'ID'],
                ['name' => 'username',  'value' => $this->username, 'prompt'    =>  'Username'],
                ['name' => 'name',      'value' => $this->name,     'prompt'    =>  'Nama Lengkap'],
                ['name' => 'email',     'value' => $this->email,    'prompt'    =>  'Email'],
                ['name' => 'type',      'value' => $this->type,     'prompt'    =>  'Tipe User'],
            ],

            '_links'    => [
                [
                    'rel'       => 'show',
                    'method'    => 'GET',
                    'href'      => route('users.show', $this->id),
                    'prompt'    =>  'Detail Data User'
                ],
                [
                    'rel'       => 'index',
                    'method'    => 'GET',
                    'href'      => route('users.index'),
                    'prompt'    =>  'Daftar User'
                ],
                [
                    'rel'       => 'update',
                    'method'    => 'PUT',
                    'href'      => route('users.update', $this->id),
                    'prompt'    =>  'Update Data User'
                ],
                [
                    'rel'       => 'delete',
                    'method'    => 'DELETE',
                    'href'      => route('users.destroy', $this->id),
                    'prompt'    =>  'Hapus Data User'
                ],
            ]
        ];
        // Logika kondisional jika tipe user adalah guru
        if ($this->type === 'guru' && $this->guru) {
            $res['_links'][] = [
                'rel'    => 'guru_profile',
                'method' => 'GET',
                'href'   => route('guru.show', $this->guru->id),
                'prompt'    =>  'Detail User Pada Guru'
            ];
        }

        return $res;
    }

    # Template untuk
    public function getTemplateData()
    {
        return [
            ['name' => 'username', 'value' => '', 'prompt' => 'Username'],
            ['name' => 'name', 'value' => '', 'prompt' => 'Nama lengkap'],
            ['name' => 'email', 'value' => '', 'prompt' => 'Email'],
            [
                'name' => 'type',
                'value' => '',
                'prompt' => 'Tipe User',
                'options' => [
                    ['value' => 'admin', 'prompt' => 'Admin'],
                    ['value' => 'guru', 'prompt' => 'Guru'],
                ]
        ],
            ['name' => 'password', 'value' => '', 'prompt' => 'Kata Sandi'],
        ];
    }

     # Template untuk queries
    public function getFilterDefinitions()
    {
    return [
            [
                'name'   => 'username',
                'value' => '',
                'prompt' => 'Filter berdasarkan Username'
            ],
            [
                'name'   => 'name',
                'value' => '',
                'prompt' => 'Filter berdasarkan nama'
            ],
            [
                'name'   => 'type',
                'value' => '',
                'prompt' => 'Filter berdasarkan tipe user',
                'options' =>
                    [
                        ['value' => 'admin', 'prompt' => 'Admin'],
                        ['value' => 'guru', 'prompt' => 'Guru']
                    ]
            ],
            [
                'name'   => 'q',
                'value' => '',
                'prompt' => 'Pencarian umum'
            ],
        ];
    }
}


