<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        return MedicalRecord::with('patient')->orderBy('date', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
    'patient_id' => 'required|exists:users,id', 
    'date' => 'required|date',
    'summary' => 'required|string',
    'doctor' => 'nullable|string',
]);


        $record = MedicalRecord::create($validated);

        return response()->json($record, 201);
    }

    public function show($id)
    {
        return MedicalRecord::with('patient')->findOrFail($id);
    }

    public function destroy($id)
    {
        MedicalRecord::findOrFail($id)->delete();
        return response()->json(['message' => 'Historial eliminado']);
    }
}

