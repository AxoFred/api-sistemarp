<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UsuariosController;

/*
|--------------------------------------------------------------------------
| API Routes - Saborytec (Versión Protegida Universitaria)
|--------------------------------------------------------------------------
*/

// Estado de la API (Público solo para verificar que el servidor vive)
Route::get('/', function () {
    return response()->json(['status' => 'API sistemaRP funcionando correctamente']);
});

Route::get('/crear-enlace-storage', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return '¡Enlace simbólico creado con éxito en la nube de Railway!';
});

/******************************************************************
 *                        RUTAS PÚBLICAS                          *
 ******************************************************************/

// Única puerta de entrada: Login
Route::post('login', [AuthController::class, 'login'])->name('login');

/******************************************************************
 *                       RUTAS PROTEGIDAS                         *
 ******************************************************************/
// todo lo que esté aquí dentro requiere el token "auth_token"
Route::middleware('auth:sanctum')->group(function () {

    // --- SESIÓN ---
    Route::post('logout', [AuthController::class, 'logout']);


    // --- GESTIÓN DE USUARIOS (ADMIN) ---
    Route::get('usuarios/ocultos', [UsuariosController::class, 'indexOcultos']);
    Route::patch('usuarios/{id}/activar', [UsuariosController::class, 'activar']);
    Route::apiResource('usuarios', UsuariosController::class);
    

    
});