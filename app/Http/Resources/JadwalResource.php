<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;

class JadwalResource extends BaseResource
{
    public function getModel() {
        return Jadwal::class;
    }

    public function getGlobalSearchColumns()
    {
    // Untuk filter 'q'
    return ['kelas_id', 'guru_id', 'mapel_id', 'hari'];
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'href'  => route('jadwal.show', $this->id),
            'data'  => [
                ['name' => 'id',            'value' => $this->id,           'prompt'    =>  'ID'],
                ['name' => 'kelas_id',      'value' => $this->kelas_id,     'prompt'    =>  'ID Kelas'],
                ['name' => 'mapel_id',      'value' => $this->mapel_id,     'prompt'    =>  'ID Mapel'],
                ['name' => 'guru_id',       'value' => $this->guru_id,      'prompt'    =>  'ID guru'],
                ['name' => 'hari',          'value' => $this->hari,         'prompt'    =>  'Hari'],
                ['name' => 'jam_pelajaran',   'value' => $this->jam_pelajaran,'prompt'    =>  'Jam Pelajaran'],
            ],

            // HATEAOS
            '_links'        => [
                [
                    'rel'       => 'self',
                    'method'    => 'GET',
                    'href'      =>  route('jadwal.show', $this->id),
                    'prompt'    =>  'Detali Data Jadwal ',
                ],
                [
                    'rel'       => 'index',
                    'method'    => 'GET',
                    'href'      =>  route('jadwal.index'),
                    'prompt'    =>  'Daftar Semua jadwal',
                ],
                [
                    'rel'       => 'update',
                    'method'    => 'PUT',
                    'href'      =>  route('jadwal.update', $this->id),
                    'prompt'    =>  'Update Data Jadwal',
                ],
                [
                    'rel'       => 'delete',
                    'method'    => 'DELETE',
                    'href'      =>  route('jadwal.destroy', $this->id),
                    'prompt'    =>  'Hapus Data Jadwal',
                ],
                [
                    'rel'       => 'kelas_detail',
                    'method'    => 'GET',
                    'href'      =>  route('kelas.show', $this->kelas_id),
                    'prompt'    =>  'Detail Kelas Pada Jadwal',
                ],
                [
                    'rel'       => 'mapel_detail',
                    'method'    => 'GET',
                    'href'      =>  route('mapel.show', $this->mapel_id),
                    'prompt'    =>  'Detail Mapel Pada Jadwal',
                ],
                [
                    'rel'       => 'guru_detail',
                    'method'    => 'GET',
                    'href'      =>  route('guru.show', $this->guru_id),
                    'prompt'    =>  'Detail Guru Pada Jadwal',
                ],
            ]
        ];
    }

    # Template untuk template
    public function getTemplateData()
    {
        return [
            [
                'name' => 'kelas_id',
                'value' => '',
                'prompt' => 'Pilih Kelas',
                'options' => Kelas::select('id', 'nama_kelas')->get()->map(fn($k) => [
                    'value' => $k->id, 'prompt' => $k->nama_kelas
                ])
            ],
            [
                'name' => 'mapel_id',
                'value' => '',
                'prompt' => 'Pilih Mata Pelajaran',
                'options' => Mapel::select('id', 'nama_mapel')->get()->map(fn($m) => [
                    'value' => $m->id, 'prompt' => $m->nama_mapel
                ])
            ],
            [
                'name' => 'guru_id',
                'value' => '',
                'prompt' => 'Pilih Guru Pengajar',
                'options' => Guru::select('id', 'nama')->get()->map(fn($g) => [
                    'value' => $g->id, 'prompt' => $g->nama
                ])
            ],
            [
                'name' => 'hari',
                'value' => '',
                'prompt' => 'Hari Pelaksanaan',
                'options' => [
                    ['value' => 'senin', 'prompt' => 'Senin'],
                    ['value' => 'selasa', 'prompt' => 'Selasa'],
                    ['value' => 'rabu', 'prompt' => 'Rabu'],
                    ['value' => 'kamis', 'prompt' => 'Kamis'],
                    ['value' => 'jumat', 'prompt' => 'Jumat'],
                    ['value' => 'sabtu', 'prompt' => 'Sabtu'],
                ]
            ],
            ['name' => 'jam_pelajaran', 'value' => '', 'prompt' => 'Jam Pelajaran'],
        ];
    }

    # Template untuk queries
    public function getFilterDefinitions()
    {
        return [
            [
                'name' => 'kelas_id',
                'value' => '',
                'prompt' => 'Filter per Kelas',
                'options' => Kelas::select('id', 'nama_kelas')->get()->map(fn($k) => [
                    'value' => $k->id, 'prompt' => $k->nama_kelas
                ])
            ],
            [
                'name' => 'guru_id',
                'value' => '',
                'prompt' => 'Filter per Guru',
                'options' => Guru::select('id', 'nama')->get()->map(fn($g) => [
                    'value' => $g->id, 'prompt' => $g->nama
                ])
            ],
            [
                'name' => 'hari',
                'value' => '',
                'prompt' => 'Filter per Hari',
                'options' => [
                    ['value' => 'senin', 'prompt' => 'Senin'],
                    ['value' => 'selasa', 'prompt' => 'Selasa'],
                    ['value' => 'rabu', 'prompt' => 'Rabu'],
                    ['value' => 'kamis', 'prompt' => 'Kamis'],
                    ['value' => 'jumat', 'prompt' => 'Jumat'],
                    ['value' => 'sabtu', 'prompt' => 'Sabtu'],
                ]
            ],
            ['name' => 'q', 'value' => '', 'prompt' => 'Pencarian umum'],
        ];
    }
}
