<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index()
    {
        return Appointment::orderBy('date')->orderBy('time')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        $appointment = Appointment::create($validated);

        return response()->json($appointment, 201);
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json(['message' => 'Cita eliminada']);
    }
    public function pendientes()
    {
    return Appointment::where('status', 'pendiente')
        ->orderBy('date')
        ->orderBy('time')
        ->get();
    }

    public function stats()
{
    return response()->json([
        'total' => Appointment::count(),
        'pendientes' => Appointment::where('status', 'pendiente')->count(),
        'realizadas' => Appointment::where('status', 'realizada')->count(),
        'proxima' => Appointment::where('status', 'pendiente')
            ->orderBy('date')
            ->orderBy('time')
            ->first(),
    ]);
}

}
