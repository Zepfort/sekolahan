<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KelasResource extends JsonResource
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
            'nama_kelas'    => $this->nama_kelas,

            '_links' => [
                [
                    'rel'       => 'self',
                    'method'    =>  'GET',
                    'href'      =>  route('kelas.show', $this->id),
                ],
                [
                    'rel'       => 'index',
                    'method'    =>  'GET',
                    'href'      =>  route('kelas.index'),
                ],
                [
                    'rel'       => 'update',
                    'method'    =>  'PUT',
                    'href'      =>  route('kelas.update', $this->id),
                ],
                [
                    'rel'       => 'delete',
                    'method'    =>  'DELETE',
                    'href'      =>  route('kelas.destroy', $this->id),
                ],
            ]
        ];
    }
}
