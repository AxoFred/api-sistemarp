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
    
    // residencias
    Route::get('/residencias', [ResidenciaController::class, 'index']);
    Route::post('/residencias', [ResidenciaController::class, 'store']);
    Route::get('/residencias/{id}', [ResidenciaController::class, 'show']);
    Route::put('/residencias/{id}', [ResidenciaController::class, 'update']);
    Route::delete('/residencias/{id}', [ResidenciaController::class, 'destroy']);

    // visitas industriales
    Route::get('/visitas-industriales', [VisitaIndustrialController::class, 'index']);
    Route::post('/visitas-industriales', [VisitaIndustrialController::class, 'store']);
    Route::get('/visitas-industriales/{id}', [VisitaIndustrialController::class, 'show']);
    Route::put('/visitas-industriales/{id}', [VisitaIndustrialController::class, 'update']);
    Route::delete('/visitas-industriales/{id}', [VisitaIndustrialController::class, 'destroy']);

    // niveles educando
    Route::get('/niveles-educando', [NivelEducandoController::class, 'index']);
    Route::post('/niveles-educando', [NivelEducandoController::class, 'store']);
    Route::get('/niveles-educando/{id}', [NivelEducandoController::class, 'show']);
    Route::put('/niveles-educando/{id}', [NivelEducandoController::class, 'update']);
    Route::delete('/niveles-educando/{id}', [NivelEducandoController::class, 'destroy']);

    // educandos
    Route::get('/educandos', [EducandoController::class, 'index']);
    Route::post('/educandos', [EducandoController::class, 'store']);
    Route::get('/educandos/{id}', [EducandoController::class, 'show']);
    Route::put('/educandos/{id}', [EducandoController::class, 'update']);
    Route::delete('/educandos/{id}', [EducandoController::class, 'destroy']);

    // alfabetizatec
    Route::get('/alfabetizatec', [AlfabetizatecController::class, 'index']);
    Route::post('/alfabetizatec', [AlfabetizatecController::class, 'store']);
    Route::get('/alfabetizatec/{id}', [AlfabetizatecController::class, 'show']);
    Route::put('/alfabetizatec/{id}', [AlfabetizatecController::class, 'update']);
    Route::delete('/alfabetizatec/{id}', [AlfabetizatecController::class, 'destroy']);
});
