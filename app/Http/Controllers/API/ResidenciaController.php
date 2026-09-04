<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Residencia;
use Illuminate\Http\Request;

class ResidenciaController extends Controller
{
    public function index()
    {
        $residencias = Residencia::with(['matricula', 'convenio'])->get();
        return response()->json(['success' => true, 'data' => $residencias], 200);
    }

    public function show($id)
    {
        $residencia = Residencia::with(['matricula', 'convenio'])->find($id);
        if (!$residencia) {
            return response()->json(['success' => false, 'message' => 'Residencia no encontrada'], 404);
        }
        return response()->json(['success' => true, 'data' => $residencia], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Dependencia' => 'required|string|max:250',
            'Sector' => 'nullable|string|max:100',
            'Convenio(si/no)' => 'nullable|string|max:10',
            'ID_Matricula' => 'required|integer|exists:matricula,ID_VS',
            'ID_Convenio' => 'nullable|integer|exists:convenios,ID_Convenio',
        ]);

        $residencia = Residencia::create($validated);
        return response()->json(['success' => true, 'message' => 'Residencia creada', 'data' => $residencia], 201);
    }

    public function update(Request $request, $id)
    {
        $residencia = Residencia::find($id);
        if (!$residencia) {
            return response()->json(['success' => false, 'message' => 'Residencia no encontrada'], 404);
        }

        $validated = $request->validate([
            'Dependencia' => 'sometimes|required|string|max:250',
            'Sector' => 'sometimes|nullable|string|max:100',
            'Convenio(si/no)' => 'sometimes|nullable|string|max:10',
            'ID_Matricula' => 'sometimes|required|integer|exists:matricula,ID_VS',
            'ID_Convenio' => 'sometimes|nullable|integer|exists:convenios,ID_Convenio',
        ]);

        $residencia->update($validated);
        return response()->json(['success' => true, 'message' => 'Residencia actualizada', 'data' => $residencia], 200);
    }

    public function destroy($id)
    {
        $residencia = Residencia::find($id);
        if (!$residencia) {
            return response()->json(['success' => false, 'message' => 'Residencia no encontrada'], 404);
        }
        $residencia->delete();
        return response()->json(['success' => true, 'message' => 'Residencia eliminada'], 200);
    }
}