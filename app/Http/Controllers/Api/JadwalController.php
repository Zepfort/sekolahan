<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jadwal::with(['kelas', 'mapel', 'guru'])->get();

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas_id'      => 'required|exists:kelas,id',
            'mapel_id'      => 'required|exists:mapel,id',
            'guru_id'       => 'required|exists:guru,id',
            'hari'          => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_pelajaran' => 'required|string'
        ]);

        if ($validator->fails()){
            return $this->failedResponse($validator->errors(), 422);
        }

        $guruSibuk = Jadwal::where([
            'guru_id'       => $request->guru_id,
            'hari'          => $request->hari,
            'jam_pelajaran' => $request->jam_pelajaran,
        ])->exists();

        if ($guruSibuk) {
            return $this->failedResponse('Guru tersebut sudah memiliki jadwal mengajar di jam ini', 400);
        }

        $kelasTerisi = Jadwal::where([
            'kelas_id'      => $request->kelas_id,
            'hari'          => $request->hari,
            'jam_pelajaran' => $request->jam_pelajaran,
        ])->exists();

        if($kelasTerisi) {
            return $this->failedResponse('Kelas ini sudah terisi jadwal pelajaran lain!', 400);
        }

        $jadwal = Jadwal::create([
            'kelas_id'      => $request->kelas_id,
            'mapel_id'      => $request->mapel_id,
            'guru_id'   => $request->guru_id,
            'hari'      => $request->hari,
            'jam_pelajaran' => $request->jam_pelajaran,
        ]);

        if ($jadwal) {
            return $this->success($jadwal, 201, 'Jadwal berhasil dibuat!');
       }

        return $this->failedResponse('Gagal membuat jadwal', 500);
    }


    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        return $this->success($jadwal, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validator = Validator::make($request->all(), [
            'kelas_id'      => 'required|exists:kelas,id',
            'mapel_id'      => 'required|exists:mapel,id',
            'guru_id'       => 'required|exists:guru,id',
            'hari'          => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_pelajaran' => 'required|string'
        ]);

        if ($validator->fails()){
            return $this->failedResponse($validator->errors(), 422);
        }

        $guruSibuk = Jadwal::where('id', '!=', $jadwal->id)->where([
            'guru_id'       => $request->guru_id,
            'hari'          => $request->hari,
            'jam_pelajaran' => $request->jam_pelajaran,
        ])->exists();

        if ($guruSibuk) {
            return $this->failedResponse('Guru tersebut sudah memiliki jadwal mengajar di jam ini', 400);
        }

        $kelasTerisi = Jadwal::where('id', '!=', $jadwal->id)->where([
            'kelas_id'      => $request->kelas_id,
            'hari'          => $request->hari,
            'jam_pelajaran' => $request->jam_pelajaran,
        ])->exists();

        if($kelasTerisi) {
            return $this->failedResponse('Kelas ini sudah terisi jadwal pelajaran lain!', 400);
        }

        $jadwal->kelas_id = $request->kelas_id;
        $jadwal->mapel_id = $request->mapel_id;
        $jadwal->guru_id = $request->guru_id;
        $jadwal->hari = $request->hari;
        $jadwal->jam_pelajaran = $request->jam_pelajaran;

        $saved = $jadwal->save();

        if ($saved) {
            return $this->success($jadwal, 200, 'Jadwal berhasil diupdate!');
        };

        return $this->failedResponse('Jadwal gagal diupdate!', 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $deleteData = $jadwal->delete();

        if ($deleteData) {
            return $this->success(null, 200, 'Kelas berhasil dihapus!');
        }

        return $this->failedResponse('Kelas gagal dihapus!', 500);
    }
}
