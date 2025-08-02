<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;

class ClientsController extends Controller
{
    public function index()
    {
        $users = User::select([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'
        ])->get();

        return response()->json([
            'data' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at,
                    'last_login_at' => null, 
                    'role' => $user->role,    
                    'status' => 'Active'      
                ];
            })
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();
        return response(null, 204);
    }
}