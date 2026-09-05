<?php

use App\Http\Controllers\API\AlfabetizatecController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UsuariosController;
use App\Http\Controllers\API\CarreraController;
use App\Http\Controllers\API\MatriculaController;
use App\Http\Controllers\API\ServicioSocialController;
use App\Http\Controllers\API\ConvenioController;
use App\Http\Controllers\API\EducandoController;
use App\Http\Controllers\API\NivelEducandoController;
use App\Http\Controllers\API\ResidenciaController;
use App\Http\Controllers\API\VisitaIndustrialController;

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
 *                         RUTAS PÚBLICAS                          *
 ******************************************************************/

// Única puerta de entrada: Login
Route::post('login', [AuthController::class, 'login'])->name('login');

/******************************************************************
 *                        RUTAS PROTEGIDAS                         *
 ******************************************************************/
Route::middleware('auth:sanctum')->group(function () {

    // --- SESIÓN ---
    Route::post('logout', [AuthController::class, 'logout']);

    // --- GESTIÓN DE USUARIOS (ADMIN) ---
    Route::get('usuarios/ocultos', [UsuariosController::class, 'indexOcultos']);
    Route::patch('usuarios/{id}/activar', [UsuariosController::class, 'activar']);
    Route::apiResource('usuarios', UsuariosController::class);
    
    // --- MÓDULOS DEL SISTEMA (API RESOURCES) ---
    Route::apiResource('carreras', CarreraController::class);
    Route::apiResource('matriculas', MatriculaController::class);
    Route::apiResource('convenios', ConvenioController::class);
    Route::apiResource('servicio-social', ServicioSocialController::class);
    Route::apiResource('residencias', ResidenciaController::class);
    Route::apiResource('visitas-industriales', VisitaIndustrialController::class);
    Route::apiResource('niveles-educando', NivelEducandoController::class);
    Route::apiResource('educandos', EducandoController::class);
    Route::apiResource('alfabetizatec', AlfabetizatecController::class);
    
});