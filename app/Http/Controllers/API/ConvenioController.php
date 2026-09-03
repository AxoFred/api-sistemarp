<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Convenio;
use Illuminate\Http\Request;

class ConvenioController extends Controller
{
    // Obtener todos los convenios
    public function index()
    {
        $convenios = Convenio::all();

        return response()->json([
            'success' => true,
            'data' => $convenios
        ], 200);
    }

    // Obtener un convenio específico
    public function show($id)
    {
        $convenio = Convenio::find($id);

        if (!$convenio) {
            return response()->json([
                'success' => false,
                'message' => 'Convenio no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $convenio
        ], 200);
    }

    // Crear un convenio
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Anio' => 'required|integer',
            'Empresa_organismo_institucion_dependencia' => 'required|string|max:250',
            'Objetivo_convenio' => 'nullable|string|max:500',
            'Area_seguimiento' => 'nullable|string|max:200',
            'Nombre_celebra_convenio' => 'nullable|string|max:100',
            'Primer_apellido_celebra_convenio' => 'nullable|string|max:100',
            'Segundo_apellido_celebra_convenio' => 'nullable|string|max:100',
            'Tipo' => 'nullable|string|max:20',
            'Pertenece_tecnm' => 'nullable|string|max:10',
            'Nacional_Internacional' => 'nullable|string|max:20',
            'Sector' => 'nullable|string|max:100',
            'Fecha_firma_convenio' => 'nullable|date',
            'Fecha_inicio_convenio' => 'nullable|date',
            'Vigencia_convenio' => 'nullable|string|max:100',
            'Fecha_termina' => 'nullable|date',
            'Estatus' => 'nullable|string|max:20',
            'Con_eficiencia' => 'nullable|string|max:5',
        ]);

        $convenio = Convenio::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Convenio creado correctamente',
            'data' => $convenio
        ], 201);
    }

    // Actualizar un convenio
    public function update(Request $request, $id)
    {
        $convenio = Convenio::find($id);

        if (!$convenio) {
            return response()->json([
                'success' => false,
                'message' => 'Convenio no encontrado'
            ], 404);
        }

        $validated = $request->validate([
            'Anio' => 'sometimes|required|integer',
            'Empresa_organismo_institucion_dependencia' => 'sometimes|required|string|max:250',
            'Objetivo_convenio' => 'nullable|string|max:500',
            'Area_seguimiento' => 'nullable|string|max:200',
            'Nombre_celebra_convenio' => 'nullable|string|max:100',
            'Primer_apellido_celebra_convenio' => 'nullable|string|max:100',
            'Segundo_apellido_celebra_convenio' => 'nullable|string|max:100',
            'Tipo' => 'nullable|string|max:20',
            'Pertenece_tecnm' => 'nullable|string|max:10',
            'Nacional_Internacional' => 'nullable|string|max:20',
            'Sector' => 'nullable|string|max:100',
            'Fecha_firma_convenio' => 'nullable|date',
            'Fecha_inicio_convenio' => 'nullable|date',
            'Vigencia_convenio' => 'nullable|string|max:100',
            'Fecha_termina' => 'nullable|date',
            'Estatus' => 'nullable|string|max:20',
            'Con_eficiencia' => 'nullable|string|max:5',
        ]);

        $convenio->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Convenio actualizado correctamente',
            'data' => $convenio
        ], 200);
    }

    // Eliminar un convenio
    public function destroy($id)
    {
        $convenio = Convenio::find($id);

        if (!$convenio) {
            return response()->json([
                'success' => false,
                'message' => 'Convenio no encontrado'
            ], 404);
        }

        $convenio->delete();

        return response()->json([
            'success' => true,
            'message' => 'Convenio eliminado correctamente'
        ], 200);
    }
}