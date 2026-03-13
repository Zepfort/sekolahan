<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Http\Resources\SiswaResource;
use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // Menampilkan semua Data
    {
        $model = new Siswa();
        $resourceInstance = new SiswaResource($model);

        $data = $resourceInstance->getQueryData($request);

        $resourceData = SiswaResource::collection($data)
            ->additional($resourceInstance->with($request))
            ->response()
            ->getData(true);

        // response
        return $this->success(
            $resourceData,
            200,
            'Data semua siswa berhasil diambli!'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // Membuat Data baru (POST)
    {
        $validator = Validator::make($request->all(), [
            'nis'           => 'required|unique:siswa,nis',
            'nama'          => 'required|string',
            'gender'        => 'required|in:laki-laki,perempuan',
            'tempat_lahir'  => 'required|string',
            'tgl_lahir'     => 'required|date',
            'nama_ortu'     => 'required|string',
            'phone_number'  => 'required|string|max:15' ,
            'email'         => 'required|email|unique:siswa,email',
            'alamat'        => 'required|string',
            'kelas_id'      => 'required|int',
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $siswa = Siswa::create([
            'nis'           => $request->nis,
            'nama'          => $request->nama,
            'gender'        => $request->gender,
            'tempat_lahir'  => $request->tempat_lahir,
            'nama_ortu'     => $request->nama_ortu,
            'phone_number'  => $request->phone_number,
            'email'         => $request->email,
            'alamat'        => $request->alamat,
            'kelas_id'      => $request->kelas_id,
        ]);

        $resource = new SiswaResource($siswa);

        if ($siswa) {
            return $this->success(
                $resource,
                201,
                'Siswa berhasil ditambahkan!'
            );
        }

        return $this->failedResponse('Siswa gagal ditambahkan!', 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa) // Menampilkan data berdasarkan id (GET)
    {
        $resourceInstance = new SiswaResource($siswa);

        $resourceData = $resourceInstance
                            ->response()
                            ->getData(true);

        return $this->success(
            $resourceData,
            200,
            "Detail data siswa berhasil ditemukan!"
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa) // Update Data berdasarkan id (PUT)
    {
        $validator = Validator::make($request->all(), [
            'nis'           => 'required|unique:siswa,nis,' . $siswa->id,
            'nama'          => 'required|string',
            'gender'        => 'nullable|in:laki-laki,perempuan',
            'tempat_lahir'  => 'required|string',
            'tgl_lahir'     => 'nullable|date',
            'nama_ortu'     => 'required|string',
            'phone_number'  => 'required|string|max:15',
            'email'         => 'nullable|email|unique:siswa,email,' . $siswa->id,
            'alamat'        => 'nullable|string',
            'kelas_id'      => 'required|int'
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->gender = $request->gender;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tgl_lahir = $request->tgl_lahir;
        $siswa->nama_ortu = $request->nama_ortu;
        $siswa->phone_number = $request->phone_number;
        $siswa->email = $request->email;
        $siswa->alamat = $request->alamat;
        $siswa->kelas_id = $request->kelas_id;

        $saved = $siswa->save();

        $resource = new SiswaResource($siswa);

        if($saved) {
            return $this->success(
                $resource,
                200,
                'Siswa berhasil di-update!'
            );
        }

        return $this->failedResponse('Siswa gagal di-update!', 500);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa) // Hapus data berdasarkan id (DELETE)
    {
        $deleteData = $siswa->delete();

        if ($deleteData) {
            return $this->success(null, 200, 'Siswa berhasil dihapus!');
        }

        return $this->failedResponse('Siswa gagal dihapus!', 500);
    }
}
