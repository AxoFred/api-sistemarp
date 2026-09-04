<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Educando;
use Illuminate\Http\Request;

class EducandoController extends Controller
{
    public function index()
    {
        $educandos = Educando::with('nivelEducando')->get();
        return response()->json(['success' => true, 'data' => $educandos], 200);
    }

    public function show($id)
    {
        $educando = Educando::with('nivelEducando')->find($id);
        if (!$educando) {
            return response()->json(['success' => false, 'message' => 'Educando no encontrado'], 404);
        }
        return response()->json(['success' => true, 'data' => $educando], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nombre' => 'required|string|max:200',
            'Sexo' => 'nullable|string|max:20',
            'Lvl_Estudio_Cursando' => 'nullable|string|max:100',
            'ID_Lvl' => 'required|integer|exists:niveles_educando,ID_Lvl',
        ]);

        $educando = Educando::create($validated);
        return response()->json(['success' => true, 'message' => 'Educando creado', 'data' => $educando], 201);
    }

    public function update(Request $request, $id)
    {
        $educando = Educando::find($id);
        if (!$educando) {
            return response()->json(['success' => false, 'message' => 'Educando no encontrado'], 404);
        }

        $validated = $request->validate([
            'Nombre' => 'sometimes|required|string|max:200',
            'Sexo' => 'sometimes|nullable|string|max:20',
            'Lvl_Estudio_Cursando' => 'sometimes|nullable|string|max:100',
            'ID_Lvl' => 'sometimes|required|integer|exists:niveles_educando,ID_Lvl',
        ]);

        $educando->update($validated);
        return response()->json(['success' => true, 'message' => 'Educando actualizado', 'data' => $educando], 200);
    }

    public function destroy($id)
    {
        $educando = Educando::find($id);
        if (!$educando) {
            return response()->json(['success' => false, 'message' => 'Educando no encontrado'], 404);
        }
        $educando->delete();
        return response()->json(['success' => true, 'message' => 'Educando eliminado'], 200);
    }
}