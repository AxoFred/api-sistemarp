<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ServicioSocial;
use Illuminate\Http\Request;

class ServicioSocialController extends Controller
{
    // Obtener todos los servicios sociales
    public function index()
    {
        $servicios = ServicioSocial::with(['matricula', 'convenio'])->get();

        return response()->json([
            'success' => true,
            'data' => $servicios
        ], 200);
    }

    // Obtener un servicio social específico
    public function show($id)
    {
        $servicio = ServicioSocial::with(['matricula', 'convenio'])
            ->find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio social no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $servicio
        ], 200);
    }

    // Crear un servicio social
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Sector' => 'nullable|string|max:100',
            'Dependencia' => 'nullable|string|max:200',
            'Area/Departamento' => 'nullable|string|max:200',
            'Municipio/Comunidad' => 'nullable|string|max:200',
            'Convenio(si/no)' => 'nullable|string|max:10',
            'Programa' => 'nullable|string|max:200',
            'Actividades_Problemas' => 'nullable|string|max:500',
            'Actividades_Inclusion_Igualdad' => 'nullable|string|max:500',
            'No_Personas_Beneficiadas_SS_Reporte_1' => 'nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Reporte_2' => 'nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Reporte_3' => 'nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Acumulados_Periodo' => 'nullable|integer|min:0',
            'Evalucion_SS' => 'nullable|string|max:100',
            'Situacion' => 'nullable|string|max:100',
            'ID_Matricula' => 'required|integer|exists:matricula,ID_VS',
            'ID_Convenio' => 'nullable|integer|exists:convenios,ID_Convenio',
        ]);

        $servicio = ServicioSocial::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Servicio social creado correctamente',
            'data' => $servicio
        ], 201);
    }

    // Actualizar un servicio social
    public function update(Request $request, $id)
    {
        $servicio = ServicioSocial::find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio social no encontrado'
            ], 404);
        }

        $validated = $request->validate([
            'Sector' => 'sometimes|nullable|string|max:100',
            'Dependencia' => 'sometimes|nullable|string|max:200',
            'Area/Departamento' => 'sometimes|nullable|string|max:200',
            'Municipio/Comunidad' => 'sometimes|nullable|string|max:200',
            'Convenio(si/no)' => 'sometimes|nullable|string|max:10',
            'Programa' => 'sometimes|nullable|string|max:200',
            'Actividades_Problemas' => 'sometimes|nullable|string|max:500',
            'Actividades_Inclusion_Igualdad' => 'sometimes|nullable|string|max:500',
            'No_Personas_Beneficiadas_SS_Reporte_1' => 'sometimes|nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Reporte_2' => 'sometimes|nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Reporte_3' => 'sometimes|nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Acumulados_Periodo' => 'sometimes|nullable|integer|min:0',
            'Evalucion_SS' => 'sometimes|nullable|string|max:100',
            'Situacion' => 'sometimes|nullable|string|max:100',
            'ID_Matricula' => 'sometimes|required|integer|exists:matricula,ID_VS',
            'ID_Convenio' => 'sometimes|nullable|integer|exists:convenios,ID_Convenio',
        ]);

        $servicio->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Servicio social actualizado correctamente',
            'data' => $servicio
        ], 200);
    }

    // Eliminar un servicio social
    public function destroy($id)
    {
        $servicio = ServicioSocial::find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio social no encontrado'
            ], 404);
        }

        $servicio->delete();

        return response()->json([
            'success' => true,
            'message' => 'Servicio social eliminado correctamente'
        ], 200);
    }
}