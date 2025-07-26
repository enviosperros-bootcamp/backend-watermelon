<?php

namespace App\Http\Controllers;

use App\Models\HistorialED;
use Illuminate\Http\Request;

class HistorialEDController extends Controller
{
    public function index()
    {
        return HistorialED::with('patient')->orderBy('date', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'summary' => 'required|string',
            'doctor' => 'nullable|string',
        ]);

        $historial = HistorialED::create($validated);
        return response()->json($historial, 201);
    }

    public function show($id)
    {
        return HistorialED::with('patient')->findOrFail($id);
    }

    public function destroy($id)
    {
        HistorialED::findOrFail($id)->delete();
        return response()->json(['message' => 'HistorialED eliminado']);
    }
}

