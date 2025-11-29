<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RetoDiario;

class RetoDiarioController extends Controller
{
    public function obtenerRetoDiario(Request $request)
    {
        try {
            // Obtiene el usuario autenticado desde la solicitud
            $user = $request->user();
            
            // Obtiene la motivación del usuario o usa un valor por defecto
            $motivacion = $user->motivacion ?? 'Consejos prácticos';
            
            // Busca un reto aleatorio de la categoría del usuario que esté activo
            $reto = RetoDiario::where('categoria', $motivacion)
                            ->where('activo', true)
                            ->inRandomOrder()
                            ->first();
            
            // Si no encuentra retos en esa categoría, busca en cualquier categoría activa
            if (!$reto) {
                $reto = RetoDiario::where('activo', true)
                                ->inRandomOrder()
                                ->first();
            }
            
            // Devuelve el reto en formato JSON
            return response()->json([
                'success' => true,
                'reto' => $reto
            ]);
            
        } catch (\Exception $e) {
            // Maneja cualquier error que ocurra durante el proceso
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener reto'
            ], 500);
        }
    }
}