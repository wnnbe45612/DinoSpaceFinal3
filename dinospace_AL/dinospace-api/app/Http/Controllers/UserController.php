<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        // Obtiene el usuario autenticado usando el token
        $user = auth()->user();

        // Verifica si el usuario existe y está autenticado
        if (!$user) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        // Valida los campos que pueden ser actualizados
        $request->validate([
            'ciclo' => 'nullable|string',
            'estadoEmocional' => 'nullable|string',
            'horasSueno' => 'nullable|string',
            'actividad' => 'nullable|string',
            'motivacion' => 'nullable|string',
            'edad' => 'nullable|integer',

        ]);

        // Actualiza los datos del usuario con la información recibida
        $user->update([
            'ciclo' => $request->ciclo,
            'estado_emocional' => $request->estadoEmocional,
            'horas_sueno' => $request->horasSueno,
            'actividad' => $request->actividad,
            'motivacion' => $request->motivacion,
            'edad' => $request->edad,
        ]);

        // Retorna una respuesta de éxito con los datos actualizados
        return response()->json([
            'message' => 'Perfil actualizado correctamente',
            'user' => $user
        ]);
    }
}