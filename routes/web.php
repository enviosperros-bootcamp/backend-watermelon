<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/test-mailpit', function () {
    Mail::raw('Hola, este es un correo de prueba enviado a Mailpit desde Laravel en Laragon.', function ($message) {
        $message->to('test@example.com')
                ->subject('Correo de prueba Mailpit');
    });

    return 'Correo enviado (o al menos intentado)';
});


Route::post('login', [AuthenticationController::class, 'login'])
    ->name('login');

Route::post('register', [RegistrationController::class, 'register'])
    ->name('register');

Route::get('clients/index', [ClientsController::class, 'index'])
    ->name('clients.index');

Route::delete('clients/{user}/destroy', [ClientsController::class, 'delete'])
    ->name('clients.destroy');

Route::get('/', function () {
    return view('welcome');


});
