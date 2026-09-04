<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\NivelEducando;
use Illuminate\Http\Request;

class NivelEducandoController extends Controller
{
    public function index()
    {
        $niveles = NivelEducando::all();
        return response()->json(['success' => true, 'data' => $niveles], 200);
    }

    public function show($id)
    {
        $nivel = NivelEducando::find($id);
        if (!$nivel) {
            return response()->json(['success' => false, 'message' => 'Nivel no encontrado'], 404);
        }
        return response()->json(['success' => true, 'data' => $nivel], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nivel' => 'required|string|max:50|unique:niveles_educando,Nivel',
        ]);

        $nivel = NivelEducando::create($validated);
        return response()->json(['success' => true, 'message' => 'Nivel creado', 'data' => $nivel], 201);
    }

    public function update(Request $request, $id)
    {
        $nivel = NivelEducando::find($id);
        if (!$nivel) {
            return response()->json(['success' => false, 'message' => 'Nivel no encontrado'], 404);
        }

        $validated = $request->validate([
            'Nivel' => 'required|string|max:50|unique:niveles_educando,Nivel,' . $id . ',ID_Lvl',
        ]);

        $nivel->update($validated);
        return response()->json(['success' => true, 'message' => 'Nivel actualizado', 'data' => $nivel], 200);
    }

    public function destroy($id)
    {
        $nivel = NivelEducando::find($id);
        if (!$nivel) {
            return response()->json(['success' => false, 'message' => 'Nivel no encontrado'], 404);
        }
        // Nota: Delete fallará si está en uso debido al 'ON DELETE RESTRICT' en BD
        $nivel->delete();
        return response()->json(['success' => true, 'message' => 'Nivel eliminado'], 200);
    }
}