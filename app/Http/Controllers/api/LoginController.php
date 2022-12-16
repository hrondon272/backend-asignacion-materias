<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use DB;



class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'), $request['remember_me'])) {
            return response()->json(['respuesta' => 'Error, usuario y/o contraseña incorrectos'], 200);
        }else{
            $usuario = User::where('email', $request['email'])->firstOrFail();
            $token = $usuario->createToken('auth_token')->plainTextToken;
            return response()->json([
                        'respuesta' => 1,
                        'access_token' => $token,
                        'token_type' => 'Bearer',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $usuario = $request->user();
        return response()->json(['respuesta' => $usuario->tokens()->delete()], 200);
    }

    public function verifySession(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        return response()->json(['respuesta' => $token == null ? false : true], 200);
    }
}
