<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RetoDiarioController;
use App\Http\Controllers\ConsejoController;
use App\Http\Controllers\ChatController;

// Rutas públicas (no requieren autenticación)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/consejo-del-dia', [ConsejoController::class, 'obtenerConsejoAleatorio']);

// Rutas protegidas (requieren estar logueado con token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Obtiene el perfil del usuario autenticado
    Route::get('/profile', [AuthController::class, 'profile']);
    
    // Cierra la sesión del usuario
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Actualiza los datos del usuario
    Route::put('/user/update', [UserController::class, 'update']);
    
    // Obtiene un reto diario personalizado
    Route::get('/reto-diario', [RetoDiarioController::class, 'obtenerRetoDiario']);
    
    // Rutas del chat protegidas para que cada usuario tenga sus propios mensajes
    Route::prefix('chat')->group(function () {
        Route::post('/send', [ChatController::class, 'sendMessage']);
        Route::get('/history/{sessionId}', [ChatController::class, 'getConversationHistory']);
    });
});