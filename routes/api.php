<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UsuariosController;
use App\Http\Controllers\API\CarreraController;
use App\Http\Controllers\API\MatriculaController;
use App\Http\Controllers\API\ServicioSocialController;
use App\Http\Controllers\API\ConvenioController;


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
Route::middleware('auth:sanctum')->group(function () {

    // --- SESIÓN ---
    Route::post('logout', [AuthController::class, 'logout']);


    // --- GESTIÓN DE USUARIOS (ADMIN) ---
    Route::get('usuarios/ocultos', [UsuariosController::class, 'indexOcultos']);
    Route::patch('usuarios/{id}/activar', [UsuariosController::class, 'activar']);
    Route::apiResource('usuarios', UsuariosController::class);
    
    //carreras
    Route::get('/carreras', [CarreraController::class, 'index']);
    Route::post('/carreras', [CarreraController::class, 'store']);
    Route::get('/carreras/{id}', [CarreraController::class, 'show']);
    Route::put('/carreras/{id}', [CarreraController::class, 'update']);
    Route::delete('/carreras/{id}', [CarreraController::class, 'destroy']);
    //matriculas
    Route::get('/matriculas', [MatriculaController::class, 'index']);
    Route::post('/matriculas', [MatriculaController::class, 'store']);
    Route::get('/matriculas/{id}', [MatriculaController::class, 'show']);
    Route::put('/matriculas/{id}', [MatriculaController::class, 'update']);
    Route::delete('/matriculas/{id}', [MatriculaController::class, 'destroy']);
    // convenios
    Route::get('/convenios', [ConvenioController::class, 'index']);
    Route::post('/convenios', [ConvenioController::class, 'store']);
    Route::get('/convenios/{id}', [ConvenioController::class, 'show']);
    Route::put('/convenios/{id}', [ConvenioController::class, 'update']);
    Route::delete('/convenios/{id}', [ConvenioController::class, 'destroy']);
    // servicio social
    Route::get('/servicio-social', [ServicioSocialController::class, 'index']);
    Route::post('/servicio-social', [ServicioSocialController::class, 'store']);
    Route::get('/servicio-social/{id}', [ServicioSocialController::class, 'show']);
    Route::put('/servicio-social/{id}', [ServicioSocialController::class, 'update']);
    Route::delete('/servicio-social/{id}', [ServicioSocialController::class, 'destroy']);
   
});
