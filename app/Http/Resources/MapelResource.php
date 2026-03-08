<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapelResource extends JsonResource
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
            'kode_mapel'    => $this->kode_mapel,
            'nama_mapel'    => $this->nama_mapel,

            '_links' => [
                [
                    'rel'       => 'self',
                    'method'    =>  'GET',
                    'href'      =>  route('mapel.show', $this->id),
                ],
                [
                    'rel'       => 'index',
                    'method'    =>  'GET',
                    'href'      =>  route('mapel.index'),
                ],
                [
                    'rel'       => 'update',
                    'method'    =>  'PUT',
                    'href'      =>  route('mapel.update', $this->id),
                ],
                [
                    'rel'       => 'delete',
                    'method'    =>  'DELETE',
                    'href'      =>  route('mapel.destroy', $this->id),
                ],
            ]
        ];
    }
}
