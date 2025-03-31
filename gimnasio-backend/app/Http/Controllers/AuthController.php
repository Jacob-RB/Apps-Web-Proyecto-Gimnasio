<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth; // ✅ Importante para JWT
use App\Models\User;

class AuthController extends Controller
{
    // ✅ Login con JWT
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Generar token JWT si las credenciales son válidas
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        return response()->json([
            'token' => $token,
            'user' => Auth::user() // Opcional: devolver datos del usuario
        ]);
    }

    // ✅ Registro con JWT
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generar token JWT automáticamente para el nuevo usuario
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'token' => $token,
            'user' => $user
        ], 201);
    }

    // ✅ Logout con JWT
    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken()); // Invalida el token actual

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}