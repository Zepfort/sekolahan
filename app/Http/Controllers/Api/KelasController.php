<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GuruResource;
use App\Http\Resources\KelasResource;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $model = new Kelas();
        $resourceInstance = new KelasResource($model);

        $data = $resourceInstance->getQueryData($request);

        $resourceData = KelasResource::collection($data)
            ->additional($resourceInstance->with($request))
            ->response()
            ->getData(true);

        return $this->success(
            $resourceData,
            200,
            'Daftar semua kelas berhasil diambil!'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_kelas'    => 'required|string|unique:kelas,kode_kelas',
            'nama_kelas'    => 'required|string|unique:kelas,nama_kelas'
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        };

        $kelas = Kelas::create([
            'kode_kelas'    => $request->kode_kelas,
            'nama_kelas'    => $request->nama_kelas
        ]);

        $resource = new KelasResource($kelas);

        if ($kelas) {
            return $this->success(
                $resource,
                201,
                'Kelas berhasil ditambahkan'
            );
        }

        return $this->failedResponse('Kelas gagal ditambahkan', 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        $resourceInstance = new KelasResource($kelas);

        $resourceData = $resourceInstance
                        ->response()
                        ->getData(true);

        return $this->success(
            $resourceData,
            200,
            "Detail data kelas berhasil ditemukan!"
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $validator = Validator::make($request->all(), [
            'kode_kelas'    => 'required|string|unique:kelas,kode_kelas,' . $kelas->id,
            'nama_kelas'    => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $kelas->kode_kelas = $request->kode_kelas;
        $kelas->nama_kelas = $request->nama_kelas;

        $saved = $kelas->save();

        $resource = new KelasResource($kelas);

        if ($saved) {
            return $this->success(
                $resource,
                200,
                'Kelas berhasil di-update!'
            );
        };

        return $this->failedResponse('Kelas gagal diupdate!', 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $deleteData = $kelas->delete();

        if ($deleteData) {
            return $this->success(null, 200, 'Kelas berhasil dihapus!');
        }

        return $this->failedResponse('Kelas gagal dihapus!', 500);
    }
}
