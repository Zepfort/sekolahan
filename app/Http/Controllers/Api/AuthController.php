<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Guard;

class AuthController extends Controller
{
    public function login(Request $request)     // login
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return $this->failedResponse(
                'Email atau Password salah',
                401
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil',
            'token'   => $token
        ]);
    }

    public function logout()    // logout
    {

        auth()->guard('api')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Logout! Token sudah tidak berlaku.'
        ]);
    }

    public function profile() // Mengambil data user yang sedang login berdasarkan token
    {
        return response()->json([
            'success' => true,
            'data'    => auth('api')->user(),
            'statusCode' => 200
        ]);
    }
}
