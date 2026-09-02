<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * CONSULTA DE CARRERAS
     * Obtiene todas las carreras.
     */
    public function index()
    {
        $carreras = Carrera::all();

        return response()->json([
            'success' => true,
            'data' => $carreras
        ], 200);
    }

    /**
     * REGISTRO DE CARRERA
     * Crea una nueva carrera.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre_Carrera' => 'required|string|max:150'
        ]);

        $carrera = Carrera::create([
            'Nombre_Carrera' => $request->Nombre_Carrera
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Carrera registrada correctamente',
            'data' => $carrera
        ], 201);
    }

    /**
     * CONSULTA DE UNA CARRERA
     * Obtiene una carrera por su ID.
     */
    public function show($id)
    {
        $carrera = Carrera::find($id);

        if (!$carrera) {
            return response()->json([
                'success' => false,
                'message' => 'Carrera no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $carrera
        ], 200);
    }

    /**
     * ACTUALIZACIÓN DE CARRERA
     * Modifica una carrera existente.
     */
    public function update(Request $request, $id)
    {
        $carrera = Carrera::find($id);

        if (!$carrera) {
            return response()->json([
                'success' => false,
                'message' => 'Carrera no encontrada'
            ], 404);
        }

        $request->validate([
            'Nombre_Carrera' => 'required|string|max:150'
        ]);

        $carrera->update([
            'Nombre_Carrera' => $request->Nombre_Carrera
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Carrera actualizada correctamente',
            'data' => $carrera
        ], 200);
    }

    /**
     * ELIMINACIÓN DE CARRERA
     * Elimina una carrera.
     */
    public function destroy($id)
    {
        $carrera = Carrera::find($id);

        if (!$carrera) {
            return response()->json([
                'success' => false,
                'message' => 'Carrera no encontrada'
            ], 404);
        }

        $carrera->delete();

        return response()->json([
            'success' => true,
            'message' => 'Carrera eliminada correctamente'
        ], 200);
    }
}