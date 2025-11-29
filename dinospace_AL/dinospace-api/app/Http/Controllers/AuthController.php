<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:17|max:65',
            'genero' => 'required|string',
            'correo' => 'required|email|unique:users,email',
            'ciclo' => 'required|string',
            'estadoEmocional' => 'required|string',
            'horasSueno' => 'required|string',
            'actividad' => 'required|string',
            'motivacion' => 'required|string',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->correo,
            'password' => Hash::make($request->password),
            'edad' => $request->edad,
            'genero' => $request->genero,
            'ciclo' => $request->ciclo,
            'estado_emocional' => $request->estadoEmocional,
            'horas_sueno' => $request->horasSueno,
            'actividad' => $request->actividad,
            'motivacion' => $request->motivacion,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        // Opcional: borrar tokens antiguos para evitar acumulación
        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    public function logout(Request $request)
    {
        // Eliminar solo el token actual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }
}
