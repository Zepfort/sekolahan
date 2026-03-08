<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuruResource extends JsonResource
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
            'user_id'       => $this->user_id,
            'nip'           => $this->nip,
            'nama'          => $this->nama,
            'tempat_lahir'  => $this->tempat_lahir,
            'tgl_lahir'     => $this->tgl_lahir,
            'email'         => $this->email,
            'alamat'        => $this->alamat,
            'gender'        => $this->gender,
            'phone_number'  => $this->phone_number,
            'pendidikan'    => $this->pendidikan,

            // HATEOAS
            '_links' => [
                [
                    'rel'    => 'self',
                    'method' => 'GET',
                    'href'   => route('guru.show', $this->id)
                ],
                [
                    'rel'    => 'account_details', // Link ke data User (akun)
                    'method' => 'GET',
                    'href'   => route('users.show', $this->user_id)
                ],
                [
                    'rel'    => 'index',
                    'method' => 'GET',
                    'href'   => route('guru.index')
                ],
                [
                    'rel'    => 'update',
                    'method' => 'PUT',
                    'href'   => route('guru.update', $this->id)
                ],
                [
                    'rel'    => 'delete',
                    'method' => 'DELETE',
                    'href'   => route('guru.destroy', $this->id)
                ],
            ]
        ];
    }
}
