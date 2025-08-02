<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
public function store(Request $request)
{
    $validated = $request->validate([
        'nombre_paciente' => 'required|string',
        'motivo'          => 'required|string',
        'exploracion'     => 'nullable|string',
        'diagnostico'     => 'nullable|string',
        'tratamiento'     => 'nullable|string',
        'recetas'         => 'nullable|array',
        'recetas.*.nombre'       => 'required_with:recetas|string',
        'recetas.*.dosis'        => 'nullable|string',
        'recetas.*.indicaciones' => 'nullable|string',
    ]);

    $consulta = Consulta::create($validated);

    return response()->json([
        'message' => 'Consulta guardada correctamente',
        'consulta' => $consulta,
    ], 201);
}
public function index()
{
    $consultas = Consulta::orderBy('created_at', 'desc')->get();

    return response()->json([
        'consultas' => $consultas,
    ]);
}
public function destroy($id)
{
    $consulta = Consulta::find($id);

    if (!$consulta) {
        return response()->json(['message' => 'Consulta no encontrada'], 404);
    }

    $consulta->delete();

    return response()->json(['message' => 'Consulta eliminada correctamente'], 200);
}


}
