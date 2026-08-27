<?php

namespace App\Http\Controllers;

use App\Models\ServicioSocial;
use Illuminate\Http\Request;

class ServicioSocialController extends Controller
{
    /**
     * 2.2 CONSULTA DE SERVICIO SOCIAL
     *
     * Obtiene todos los registros de Servicio Social.
     */
    public function index()
    {
        $servicios = ServicioSocial::with('carrera')->get();

        return response()->json([
            'success' => true,
            'message' => 'Registros de Servicio Social obtenidos correctamente.',
            'data' => $servicios
        ], 200);
    }

    /**
     * CONSULTAR UN REGISTRO
     *
     * Obtiene un registro específico mediante ID_SS.
     */
    public function show($id)
    {
        $servicio = ServicioSocial::with('carrera')->find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'El registro de Servicio Social no existe.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Registro de Servicio Social encontrado.',
            'data' => $servicio
        ], 200);
    }

    /**
     * 2.1 REGISTRO DE SERVICIO SOCIAL
     *
     * Crea un nuevo registro de Servicio Social.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Datos del alumno
            'No_Control' => 'required|string|max:20',
            'Nombre' => 'required|string|max:100',
            'Apaterno' => 'required|string|max:100',
            'Amaterno' => 'nullable|string|max:100',

            // Información académica
            'Sexo' => 'required|in:H,M',
            'Semestre' => 'required|integer',
            'ID_Carrera' => 'required|integer|exists:carreras,ID_Carrera',

            // Información del Servicio Social
            'Sector' => 'required|string|max:100',
            'Dependencia' => 'required|string|max:150',
            'Area_Departamento' => 'required|string|max:150',
            'Municipio_Comunidad' => 'required|string|max:150',
            'Convenio' => 'required|in:Si,No',
            'Programa' => 'required|string|max:150',

            // Actividades
            'Actividades_Problemas' => 'nullable|string|max:500',
            'Actividades_Inclusion_Igualdad' => 'nullable|string|max:500',

            // Beneficiarios
            'No_Personas_Beneficiadas_SS_Reporte_1' => 'nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Reporte_2' => 'nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Reporte_3' => 'nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Acumulados_Periodo' => 'nullable|integer|min:0',

            // Evaluación y situación
            'Evaluacion_SS' => 'nullable|string|max:100',
            'Situacion' => 'required|string|max:500',
        ]);

        $servicio = ServicioSocial::create($validated);

        $servicio->load('carrera');

        return response()->json([
            'success' => true,
            'message' => 'Servicio Social registrado correctamente.',
            'data' => $servicio
        ], 201);
    }

    /**
     * 2.3 ACTUALIZACIÓN DE SERVICIO SOCIAL
     *
     * Modifica un registro existente.
     */
    public function update(Request $request, $id)
    {
        $servicio = ServicioSocial::find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'El registro de Servicio Social no existe.'
            ], 404);
        }

        $validated = $request->validate([
            // Datos del alumno
            'No_Control' => 'sometimes|required|string|max:20',
            'Nombre' => 'sometimes|required|string|max:100',
            'Apaterno' => 'sometimes|required|string|max:100',
            'Amaterno' => 'nullable|string|max:100',

            // Información académica
            'Sexo' => 'sometimes|required|in:H,M',
            'Semestre' => 'sometimes|required|integer',
            'ID_Carrera' => 'sometimes|required|integer|exists:carreras,ID_Carrera',

            // Información del Servicio Social
            'Sector' => 'sometimes|required|string|max:100',
            'Dependencia' => 'sometimes|required|string|max:150',
            'Area_Departamento' => 'sometimes|required|string|max:150',
            'Municipio_Comunidad' => 'sometimes|required|string|max:150',
            'Convenio' => 'sometimes|required|in:Si,No',
            'Programa' => 'sometimes|required|string|max:150',

            // Actividades
            'Actividades_Problemas' => 'nullable|string|max:500',
            'Actividades_Inclusion_Igualdad' => 'nullable|string|max:500',

            // Beneficiarios
            'No_Personas_Beneficiadas_SS_Reporte_1' => 'nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Reporte_2' => 'nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Reporte_3' => 'nullable|integer|min:0',
            'No_Personas_Beneficiadas_SS_Acumulados_Periodo' => 'nullable|integer|min:0',

            // Evaluación y situación
            'Evaluacion_SS' => 'nullable|string|max:100',
            'Situacion' => 'sometimes|required|string|max:500',
        ]);

        $servicio->update($validated);

        $servicio->load('carrera');

        return response()->json([
            'success' => true,
            'message' => 'Servicio Social actualizado correctamente.',
            'data' => $servicio
        ], 200);
    }

    /**
     * 2.4 ELIMINACIÓN DE SERVICIO SOCIAL
     *
     * Elimina un registro.
     */
    public function destroy($id)
    {
        $servicio = ServicioSocial::find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'El registro de Servicio Social no existe.'
            ], 404);
        }

        $servicio->delete();

        return response()->json([
            'success' => true,
            'message' => 'Servicio Social eliminado correctamente.'
        ], 200);
    }
}