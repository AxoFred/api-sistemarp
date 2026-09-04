<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Alfabetizatec;
use Illuminate\Http\Request;

class AlfabetizatecController extends Controller
{
    public function index()
    {
        $registros = Alfabetizatec::with(['matricula', 'educando', 'nivelEducando'])->get();
        return response()->json(['success' => true, 'data' => $registros], 200);
    }

    public function show($id)
    {
        $registro = Alfabetizatec::with(['matricula', 'educando', 'nivelEducando'])->find($id);
        if (!$registro) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado'], 404);
        }
        return response()->json(['success' => true, 'data' => $registro], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nombre_Institucion' => 'required|string|max:250',
            'ID_Matricula' => 'required|integer|exists:matricula,ID_VS',
            'Correo' => 'nullable|email|max:150',
            'Telefono' => 'nullable|string|max:20',
            'Programa_Academico' => 'nullable|string|max:150',
            'ID_Educando' => 'required|integer|exists:educandos,ID_Educando',
            'ID_Lvl' => 'required|integer|exists:niveles_educando,ID_Lvl',
        ]);

        $registro = Alfabetizatec::create($validated);
        return response()->json(['success' => true, 'message' => 'Registro creado', 'data' => $registro], 201);
    }

    public function update(Request $request, $id)
    {
        $registro = Alfabetizatec::find($id);
        if (!$registro) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado'], 404);
        }

        $validated = $request->validate([
            'Nombre_Institucion' => 'sometimes|required|string|max:250',
            'ID_Matricula' => 'sometimes|required|integer|exists:matricula,ID_VS',
            'Correo' => 'sometimes|nullable|email|max:150',
            'Telefono' => 'sometimes|nullable|string|max:20',
            'Programa_Academico' => 'sometimes|nullable|string|max:150',
            'ID_Educando' => 'sometimes|required|integer|exists:educandos,ID_Educando',
            'ID_Lvl' => 'sometimes|required|integer|exists:niveles_educando,ID_Lvl',
        ]);

        $registro->update($validated);
        return response()->json(['success' => true, 'message' => 'Registro actualizado', 'data' => $registro], 200);
    }

    public function destroy($id)
    {
        $registro = Alfabetizatec::find($id);
        if (!$registro) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado'], 404);
        }
        $registro->delete();
        return response()->json(['success' => true, 'message' => 'Registro eliminado'], 200);
    }
}