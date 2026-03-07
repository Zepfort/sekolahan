<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Guru::all();

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'      =>  'required|string|unique:users,username',
            'name'          =>  'required|string',
            'email'         =>  'required|email|unique:users,email',
            'password'     =>  'required|min:6',
            'type'          =>  'required|in:admin,guru',
            'tempat_lahir'  =>  'required|string',
            'tgl_lahir'     =>  'required|date',
            'gender'        =>  'required|in:laki-laki,perempuan',
            'phone_number'  =>  'required|string|max:15',
            'email'         =>  'required|email|unique:guru,email',
            'alamat'        =>  'required|string',
            'pendidikan'    =>  'required|string',
            'nip'           =>  'required|string|unique:guru,nip',
            'nama'          =>  'required|string',
            'phone_number'  =>  'required|string|max:15'
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $user = User::create([
            'username'  => $request->username,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'type'      => 'guru',
        ]);

        $guru = Guru::create([
            'user_id'       => $user->id,
            'nip'           => $request->nip,
            'nama'          => $request->nama,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'gender'        => $request->gender,
            'phone_number'  => $request->phone_number,
            'email'         => $request->email,
            'alamat'        => $request->alamat,
            'pendidikan'    => $request->pendidikan
        ]);

        if ($guru) {
            return $this->success($guru, 201, 'Guru berhasil ditambahkan!');
        }

        return $this->failedResponse('Guru gagal ditasmbahkan!', 500);
    }
    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        return $this->success($guru, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        $validator = Validator::make($request->all(), [
            'username'      => 'required|string|unique:users,username,' . $guru->user->id,
            'name'          => 'required|string',
            'email'         => 'required|string|unique:users,email,' . $guru->user->id,
            'nip'           => 'required|string|unique:guru,nip,' . $guru->id,
            'nama'          => 'required|string',
            'tempat_lahir'  => 'required|string',
            'tgl_lahir'     => 'required|date',
            'gender'        => 'required|in:laki-laki,perempuan',
            'phone_number'  => 'required|string|max:15',
            'email'         => 'required|string|unique:guru,email,' . $guru->id,
            'alamat'        => 'required|string',
            'pendidikan'    => 'required|string',
        ]);

        if ($validator->fails()){
            return $this->failedResponse($validator->errors(), 422);
        }

        $guru->user->username = $request->username;
        $guru->user->name = $request->name;
        $guru->user->email = $request->email;
        $guru->nip = $request->nip;
        $guru->nama = $request->nama;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tgl_lahir = $request->tgl_lahir;
        $guru->gender = $request->gender;
        $guru->phone_number = $request->phone_number;
        $guru->email = $request->email;
        $guru->alamat = $request->alamat;
        $guru->pendidikan = $request->pendidikan;

        $saved = $guru->push();

        if ($saved) {
            return $this->success($guru, 200, 'Guru berhasil diupdate!');
        }

        return $this->failedResponse('Guru gagal diupdate!', 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        $deleteData = $guru->delete();

        if ($deleteData) {
            return $this->success(null, 200, 'Guru berhasil dihapus!');
        }

        return $this->failedResponse('Guru gagal dihapus', 500);
    }
}
