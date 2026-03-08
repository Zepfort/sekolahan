<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
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
            'nis'           => $this->nis,
            'gender'        => $this->gender,
            'nama'          => $this->nama,
            'tempat_lahir'  => $this->tempat_lahir,
            'tgl_lahir'     => $this->tgl_lahir,
            'nama_ortu'     => $this->nama_ortu,
            'phone_number'  => $this->phone_number,
            'email'         => $this->email,
            'alamat'        => $this->alamat,
            'kelas_id'      => $this->kelas_id,
            // Informasi detail tentang kelas siswa
            // 'kelas'      => new KelasResource($this->whenLoaded('kelas')),

            // HATEOAS
            '_link'          => [
                [
                    'rel'   => 'self',
                    'method'=> 'GET',
                    'href'  =>  route('siswa.show', $this->id),
                ],
                [
                    'rel'   => 'index',
                    'method'=> 'GET',
                    'href'  =>  route('siswa.index'),
                ],
                [
                    'rel'   => 'update',
                    'method'=> 'PUT',
                    'href'  =>  route('siswa.update', $this->id),
                ],
                [
                    'rel'   => 'delete',
                    'method'=> 'DELETE',
                    'href'  =>  route('siswa.destroy', $this->id),
                ]
            ]
        ];
    }
}
