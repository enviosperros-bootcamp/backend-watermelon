<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();

        return response()->json([
            'data' => $patients,
        ]);
    }

    public function storeOrUpdate(Request $request)
    {
        $user = auth('api')->user();

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'sex'        => 'required|string',
            'birth_date' => 'required|date',
            'age'        => 'required|integer',
            'occupation' => 'required|string',
            'phone'      => 'required|string',
            'image'      => 'nullable|image|max:2048',
        ]);

        $patient = Patient::where('user_id', $user->id)->first();

    
        if ($request->hasFile('image')) {
           
            if ($patient && $patient->image && File::exists(public_path($patient->image))) {
                File::delete(public_path($patient->image));
            }

            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('patients'), $filename);

            $validated['image'] = 'patients/' . $filename;
        } else {
           
            if ($patient && isset($patient->image)) {
                $validated['image'] = $patient->image;
            }
        }

        $patient = Patient::updateOrCreate(
            ['user_id' => $user->id],
            array_merge($validated, ['user_id' => $user->id])
        );

        $patient->image_url = $patient->image ? asset($patient->image) : null;

        return response()->json([
            'message' => 'Perfil actualizado',
            'patient' => $patient
        ]);
    }

    public function showMyProfile()
    {
        $user = auth('api')->user();

        $patient = Patient::where('user_id', $user->id)->first();

        if (!$patient) {
            return response()->json([
                'message' => 'Perfil no encontrado',
            ], 404);
        }

        $patient->image_url = $patient->image ? asset($patient->image) : null;

        return response()->json([
            'patient' => $patient,
        ]);
    }
}
