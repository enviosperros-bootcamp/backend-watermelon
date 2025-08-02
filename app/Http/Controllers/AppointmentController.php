<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentNotification;

class AppointmentController extends Controller
{

    public function index()
    {
        return Appointment::orderBy('date')->orderBy('time')->get();
        return response()->json(Appointment::all());
    // Removed duplicate store and destroy methods
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
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'date' => 'required|date',
        'time' => 'required|string',
        'email' => 'required|email'
    ]);

    $appointment = Appointment::create($validated);

    // Enviar correo
    $details = [
        'subject' => 'Nueva cita agendada',
        'message' => 'Tu cita ha sido registrada exitosamente.',
        'appointment' => $appointment->toArray(),
    ];

    Mail::to($validated['email'])->send(new AppointmentNotification($details));

    return response()->json($appointment, 201);
}

public function destroy($id)
{
    $appointment = Appointment::findOrFail($id);
    $email = $appointment->email;

    // Enviar correo antes de borrar
    $details = [
        'subject' => 'Cita cancelada',
        'message' => 'Tu cita ha sido cancelada.',
        'appointment' => $appointment->toArray(),
    ];

    Mail::to($email)->send(new AppointmentNotification($details));

    $appointment->delete();

    return response()->json(['message' => 'Cita eliminada']);
}
}
