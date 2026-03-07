<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kelas::all();

        return $data;
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

        if ($kelas) {
            return $this->success($kelas, 201, 'Kelas berhasil ditambahkan');
        }

        return $this->failedResponse('Kelas gagal ditambahkan', 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        return $this->success($kelas, 200);
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

        if ($saved) {
            return $this->success($kelas, 200, 'Kelas berhasil diupdate!');
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
