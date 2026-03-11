<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Kelas;

class KelasResource extends BaseResource
{
    public function getModel() {
        return Kelas::class;
    }

    // Untuk filter 'q'
    public function getGlobalSearchColumns()
    {
    return ['kode_kelas', 'mapel_nama'];
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'href'  => route('kelas.show', $this->id),
            'data'  => [
                ['name' => 'id',        'value' => $this->id,           'prompt'    => 'ID'],
                ['name' => 'kode_kelas','value' => $this->kode_kelas,   'prompt'    => 'Kode Kelas'],
                ['name' => 'nama_kelas','value' => $this->nama_kelas,   'prompt'    => 'Nama Kelas'],
            ],

            '_links' => [
                [
                    'rel'       => 'self',
                    'method'    =>  'GET',
                    'href'      =>  route('kelas.show', $this->id),
                    'prompt'    =>  'Detail Data Kelas',
                ],
                [
                    'rel'       => 'index',
                    'method'    =>  'GET',
                    'href'      =>  route('kelas.index'),
                    'prompt'    =>  'Daftar Semua Kelas'
                ],
                [
                    'rel'       => 'update',
                    'method'    =>  'PUT',
                    'href'      =>  route('kelas.update', $this->id),
                    'prompt'    =>  'Updata Data Kelas'
                ],
                [
                    'rel'       => 'delete',
                    'method'    =>  'DELETE',
                    'href'      =>  route('kelas.destroy', $this->id),
                    'prompt'    =>  'Hapus Data Kelas'
                ],
            ]
        ];
    }

    # Template untuk template
     public function getTemplateData()
    {
        return [
                ['name' => 'kode_kelas', 'value' => '', 'prompt' => 'Kode Kelas '],
                ['name' => 'nama_kelas', 'value' => '', 'prompt' => 'Nama Kelas '],
            ];
    }

    # Template untuk queries
    public function getFilterDefinitions()
    {
    return [
            [
                'name'   => 'kode_kelas',
                'value' => '',
                'prompt' => 'Filter berdasarkan kode kelas'
            ],
            [
                'name'   => 'nama_kelas',
                'value' => '',
                'prompt' => 'Filter berdasarkan nama kelas'
            ],
            [
                'name'   => 'q',
                'value' => '',
                'prompt' => 'Pencarian umum'
            ],
        ];
    }
}
