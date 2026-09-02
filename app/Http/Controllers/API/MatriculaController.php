<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * CONSULTA DE MATRÍCULAS
     * Obtiene todos los registros.
     */
    public function index()
    {
        $matriculas = Matricula::with('carrera')->get();

        return response()->json([
            'success' => true,
            'data' => $matriculas
        ], 200);
    }

    /**
     * REGISTRO DE MATRÍCULA
     * Crea un nuevo registro.
     */
    public function store(Request $request)
    {
        $request->validate([
            'No_Control' => 'required|string|max:20|unique:matricula,No_Control',
            'Nombres' => 'required|string|max:100',
            'Apaterno' => 'required|string|max:100',
            'Amaterno' => 'nullable|string|max:100',
            'Rfc' => 'nullable|string|max:13',
            'Curp' => 'nullable|string|max:18',
            'Sexo' => 'nullable|string|max:20',
            'Semestres' => 'nullable|integer',
            'Periodo_Actual' => 'nullable|string|max:50',
            'ID_Carrera' => 'required|integer|exists:carreras,ID_Carrera',
        ]);

        $matricula = Matricula::create([
            'No_Control' => $request->No_Control,
            'Nombres' => $request->Nombres,
            'Apaterno' => $request->Apaterno,
            'Amaterno' => $request->Amaterno,
            'Rfc' => $request->Rfc,
            'Curp' => $request->Curp,
            'Sexo' => $request->Sexo,
            'Semestres' => $request->Semestres,
            'Periodo_Actual' => $request->Periodo_Actual,
            'ID_Carrera' => $request->ID_Carrera,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Matrícula registrada correctamente',
            'data' => $matricula
        ], 201);
    }

    /**
     * CONSULTA DE UNA MATRÍCULA
     */
    public function show($id)
    {
        $matricula = Matricula::with('carrera')->find($id);

        if (!$matricula) {
            return response()->json([
                'success' => false,
                'message' => 'Matrícula no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $matricula
        ], 200);
    }

    /**
     * ACTUALIZACIÓN DE MATRÍCULA
     */
    public function update(Request $request, $id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return response()->json([
                'success' => false,
                'message' => 'Matrícula no encontrada'
            ], 404);
        }

        $request->validate([
            'No_Control' => 'required|string|max:20|unique:matricula,No_Control,' . $id . ',ID_VS',
            'Nombres' => 'required|string|max:100',
            'Apaterno' => 'required|string|max:100',
            'Amaterno' => 'nullable|string|max:100',
            'Rfc' => 'nullable|string|max:13',
            'Curp' => 'nullable|string|max:18',
            'Sexo' => 'nullable|string|max:20',
            'Semestres' => 'nullable|integer',
            'Periodo_Actual' => 'nullable|string|max:50',
            'ID_Carrera' => 'required|integer|exists:carreras,ID_Carrera',
        ]);

        $matricula->update([
            'No_Control' => $request->No_Control,
            'Nombres' => $request->Nombres,
            'Apaterno' => $request->Apaterno,
            'Amaterno' => $request->Amaterno,
            'Rfc' => $request->Rfc,
            'Curp' => $request->Curp,
            'Sexo' => $request->Sexo,
            'Semestres' => $request->Semestres,
            'Periodo_Actual' => $request->Periodo_Actual,
            'ID_Carrera' => $request->ID_Carrera,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Matrícula actualizada correctamente',
            'data' => $matricula
        ], 200);
    }

    /**
     * ELIMINACIÓN DE MATRÍCULA
     */
    public function destroy($id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return response()->json([
                'success' => false,
                'message' => 'Matrícula no encontrada'
            ], 404);
        }

        $matricula->delete();

        return response()->json([
            'success' => true,
            'message' => 'Matrícula eliminada correctamente'
        ], 200);
    }
}