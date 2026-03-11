<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // Menampilkan semua Data
    {
        $model = new User();
        $resourceInstance = new UserResource($model);

        $data = $resourceInstance->getQueryData($request);

        $resourceData = UserResource::collection($data)
            ->additional($resourceInstance->with($request))
            ->response()
            ->getData(true);

        // default response
        return $this->success(
            $resourceData,
            200,
            'Berhasil mengambil semua data User'
        );

        // custom response
        // return $this->success($data, 200, 'Data User Berhasil di ambil');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // Membuat Data baru (POST)
    {
        $validator = Validator::make($request->all(), [
            'type'    => 'required|in:admin,guru',
            'username'=> 'required|string|unique:users,username',
            'password'=> 'required|min:6',
            'name'    => 'required|string',
            'email'   => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'type'     => $request->type,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $resource = new UserResource($user);

        if ($user) {
            return $this->success(
                $resource,
                201,
                'User berhasil ditambahkan!'
            );
        }

        return $this->failedResponse('User gagal ditambahkan!', 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) // Menampilkan data berdasarkan id (GET)
    {
        $resourceInstance = new UserResource($user);

        $resourceData = $resourceInstance
                            ->response()
                            ->getData(true);

        return $this->success(
            $resourceData,
            200,
            "Detail data user berhasil ditemukan!"
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) // Update Data berdasarkan id (PUT)
    {
        $validator = Validator::make($request->all(), [
            'type'      => 'required|in:admin,guru',
            'username'  => 'required|string|unique:users,username,' . $user->id,
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'name'      => 'required|string',
            'password'  => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $user->type = $request->type;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $saved = $user->save();

        $resource = new UserResource($user);

        if($saved) {
            return $this->success(
                $resource,
                200,
                'User berhasil diupdate!'
            );
        }

        return $this->failedResponse('User gagal diupdate!', 500);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) // Hapus data berdasarkan id (DELETE)
    {
        $deleteData = $user->delete();

        if ($deleteData) {
            return $this->success(null, 200, 'User berhasil dihapus!');
        }

        return $this->failedResponse('User gagal dihapus!', 500);
    }
}
