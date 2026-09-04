<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\VisitaIndustrial;
use Illuminate\Http\Request;

class VisitaIndustrialController extends Controller
{
    public function index()
    {
        $visitas = VisitaIndustrial::with(['matricula', 'convenio'])->get();
        return response()->json(['success' => true, 'data' => $visitas], 200);
    }

    public function show($id)
    {
        $visita = VisitaIndustrial::with(['matricula', 'convenio'])->find($id);
        if (!$visita) {
            return response()->json(['success' => false, 'message' => 'Visita no encontrada'], 404);
        }
        return response()->json(['success' => true, 'data' => $visita], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'No_Visita' => 'nullable|string|max:50',
            'Empresa' => 'required|string|max:250',
            'Materia' => 'nullable|string|max:150',
            'Grupo' => 'nullable|string|max:50',
            'Fecha_Visita' => 'nullable|date',
            'Convenio(SI/NO)' => 'nullable|string|max:10',
            'ID_Matricula' => 'required|integer|exists:matricula,ID_VS',
            'ID_Convenio' => 'nullable|integer|exists:convenios,ID_Convenio',
        ]);

        $visita = VisitaIndustrial::create($validated);
        return response()->json(['success' => true, 'message' => 'Visita creada', 'data' => $visita], 201);
    }

    public function update(Request $request, $id)
    {
        $visita = VisitaIndustrial::find($id);
        if (!$visita) {
            return response()->json(['success' => false, 'message' => 'Visita no encontrada'], 404);
        }

        $validated = $request->validate([
            'No_Visita' => 'sometimes|nullable|string|max:50',
            'Empresa' => 'sometimes|required|string|max:250',
            'Materia' => 'sometimes|nullable|string|max:150',
            'Grupo' => 'sometimes|nullable|string|max:50',
            'Fecha_Visita' => 'sometimes|nullable|date',
            'Convenio(SI/NO)' => 'sometimes|nullable|string|max:10',
            'ID_Matricula' => 'sometimes|required|integer|exists:matricula,ID_VS',
            'ID_Convenio' => 'sometimes|nullable|integer|exists:convenios,ID_Convenio',
        ]);

        $visita->update($validated);
        return response()->json(['success' => true, 'message' => 'Visita actualizada', 'data' => $visita], 200);
    }

    public function destroy($id)
    {
        $visita = VisitaIndustrial::find($id);
        if (!$visita) {
            return response()->json(['success' => false, 'message' => 'Visita no encontrada'], 404);
        }
        $visita->delete();
        return response()->json(['success' => true, 'message' => 'Visita eliminada'], 200);
    }
}