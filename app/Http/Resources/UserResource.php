<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $res = [
            'id'        => $this->id,
            'username'  => $this->username,
            'name'      => $this->name,
            'email'     => $this->email,
            'type'      => $this->type,

            // HATEAOS
            '_links'    => [
                [
                    'rel'       => 'show',
                    'method'    => 'GET',
                    'href'      => route('users.show', $this->id)
                ],
                [
                    'rel'       => 'index',
                    'method'    => 'GET',
                    'href'      => route('users.index')
                ],
                [
                    'rel'       => 'update',
                    'method'    => 'PUT',
                    'href'      => route('users.update', $this->id)
                ],
                [
                    'rel'       => 'delete',
                    'method'    => 'DELETE',
                    'href'      => route('users.destroy', $this->id)
                ],
            ]
        ];
        // Logika kondisional jika tipe user adalah guru
        if ($this->type === 'guru' && $this->guru) {
            $res['_links'][] = [
                'rel'    => 'guru_profile',
                'method' => 'GET',
                'href'   => route('guru.show', $this->guru->id)
            ];
        }

        return $res;
    }
}


