<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'kelas_id'      => $this->kelas_id,
            'mapel_id'      => $this->mapel_id,
            'guru_id'       => $this->guru_id,
            'hari'          => $this->hari,
            'jam_pelajaran' => $this->jam_pelajaran,

            // HATEAOS
            '_links'        => [
                [
                    'rel'       => 'self',
                    'method'    => 'GET',
                    'href'      =>  route('jadwal.show', $this->id)
                ],
                [
                    'rel'       => 'index',
                    'method'    => 'GET',
                    'href'      =>  route('jadwal.index')
                ],
                [
                    'rel'       => 'update',
                    'method'    => 'PUT',
                    'href'      =>  route('jadwal.update', $this->id)
                ],
                [
                    'rel'       => 'delete',
                    'method'    => 'DELETE',
                    'href'      =>  route('jadwal.destroy', $this->id)
                ],
                [
                    'rel'       => 'kelas_detail',
                    'method'    => 'GET',
                    'href'      =>  route('kelas.show', $this->kelas_id)
                ],
                [
                    'rel'       => 'mapel_detail',
                    'method'    => 'GET',
                    'href'      =>  route('mapel.show', $this->mapel_id)
                ],
                [
                    'rel'       => 'guru_detail',
                    'method'    => 'GET',
                    'href'      =>  route('guru.show', $this->guru_id)
                ],
            ]
        ];
    }
}
