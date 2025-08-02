<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) return response()->json(['message' => 'Correo no encontrado'], 404);

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        // Usa la URL del frontend para generar el link
        $frontendUrl = config('app.frontend_url');
        $resetLink = $frontendUrl . "/reset-password?token=$token&email=" . urlencode($request->email);

        // Envía el correo con el link del frontend
        Mail::raw("Haz clic para recuperar tu contraseña: $resetLink", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Recuperación de contraseña');
        });

        return response()->json(['message' => 'Correo de recuperación enviado']);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record || Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            return response()->json(['message' => 'Token inválido o expirado'], 400);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) return response()->json(['message' => 'Usuario no encontrado'], 404);

        $user->password = Hash::make($request->password);
        $user->save();

        // Elimina token usado
        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Contraseña actualizada con éxito']);
    }
}
