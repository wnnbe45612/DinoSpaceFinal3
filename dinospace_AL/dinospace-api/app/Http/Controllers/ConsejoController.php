<?php

namespace App\Http\Controllers;

use App\Models\Consejo;

class ConsejoController extends Controller
{
    public function obtenerConsejoAleatorio()
    {
        // Busca un consejo aleatorio en la base de datos
        $consejo = Consejo::inRandomOrder()->first();

        // Devuelve el consejo en formato JSON para su uso en el frontend
        return response()->json([
            'success' => true,
            'consejo' => $consejo
        ]);
    }
}