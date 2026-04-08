<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MapelResource;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $model = new Mapel();
        $resourceInstance = new MapelResource($model);

        $data = $resourceInstance->getQueryData($request);

        $resourceData = MapelResource::collection($data)
            ->additional($resourceInstance->with($request))
            ->response()
            ->getData(true);

        return $this->success(
            $resourceData,
            200,
            'Daftar semua mapel berhasil diambil!'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required|string|unique:mapel,kode_mapel',
            'nama_mapel' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $mapel = Mapel::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel
        ]);

        $resource = new MapelResource($mapel);

        if ($mapel) {
            return $this->success(
                $resource,
                201,
                'Mapel sudah ditambahkan!'
            );
        }

        return $this->failedResponse('Gagal menambahkan mapel!', 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        $resourceInstance = new MapelResource($mapel);

        $resourceData = $resourceInstance
                            ->response()
                            ->getData(true);

        return $this->success(
            $resourceData,
            200,
            "Detail data mapel berhasil ditemukan!"
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required|string|unique:mapel,kode_mapel,' . $mapel->id,
            'nama_mapel' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $mapel->kode_mapel = $request->kode_mapel;
        $mapel->nama_mapel = $request->nama_mapel;

        $saved = $mapel->save();

        $resource = new MapelResource($mapel);

        if ($saved) {
            return $this->success(
                $resource,
                200,
                'Mapel berhasil di-update!'
            );
        }

        return $this->failedResponse('Gagal mengupdate mapel!', 500);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        $deleteData = $mapel->delete();

        if ($deleteData) {
            return $this->success(null, 200, 'Berhasil hapus mapel!');
        }

        return $this->failedResponse('Gagal menghapus mapel!', 500);
    }
}
