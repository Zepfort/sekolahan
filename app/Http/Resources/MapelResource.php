<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Mapel;

class MapelResource extends BaseResource
{
    public function getModel() {
        return Mapel::class;
    }

    // Untuk filter 'q'
    public function getGlobalSearchColumns()
    {
    return ['kode_mapel', 'nama_mapel'];
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'href'  => route('mapel.show', $this->id),
            'data'  => [
                ['name' => 'id',            'value' => $this->id,           'prompt'   => 'ID'],
                ['name' => 'kode_mapel',    'value' => $this->kode_mapel,   'prompt'   => 'Kode Mapel'],
                ['name' => 'nama_mapel',    'value' => $this->nama_mapel,   'prompt'   => 'Nama Mapel'],
            ],

            '_links' => [
                [
                    'rel'       => 'self',
                    'method'    =>  'GET',
                    'href'      =>  route('mapel.show', $this->id),
                    'prompt'    =>  'Detail Data Mapel'
                ],
                [
                    'rel'       => 'index',
                    'method'    =>  'GET',
                    'href'      =>  route('mapel.index'),
                    'prompt'    =>  'Daftar Semua Mapel'
                ],
                [
                    'rel'       => 'update',
                    'method'    =>  'PUT',
                    'href'      =>  route('mapel.update', $this->id),
                    'prompt'    =>  'Update Data Mapel'
                ],
                [
                    'rel'       => 'delete',
                    'method'    =>  'DELETE',
                    'href'      =>  route('mapel.destroy', $this->id),
                    'prompt'    =>  'Hapus Data Mapel'
                ],
            ]
        ];
    }

    # Template untuk template
    public function getTemplateData()
    {
        return [
            ['name' => 'kode_mapel', 'value' => '', 'prompt' => 'Kode Mapel'],
            ['name' => 'nama_mapel', 'value' => '', 'prompt' => 'Nama Mapel'],
        ];
    }

    # Template untuk queries
    public function getFilterDefinitions()
    {
    return [
            [
                'name'   => 'kode_mapel',
                'value' => '',
                'prompt' => 'Filter berdasarkan kode mapel'
            ],
            [
                'name'   => 'nama_mapel',
                'value' => '',
                'prompt' => 'Filter berdasarkan nama mapel'
            ],
            [
                'name'   => 'q',
                'value' => '',
                'prompt' => 'Pencarian umum'
            ],
        ];
    }
}
