<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\HistorialEDController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PasswordResetController;

Route::prefix('auth')->group(function () {

    /** ---------- 🔐 Autenticación ---------- **/
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
        Route::get('user/profile', [AuthController::class, 'profile']);

        /** ---------- 👥 Pacientes (requieren token) ---------- **/
        Route::post('patients/profile', [PatientController::class, 'storeOrUpdate']);
        Route::get('patients/me', [PatientController::class, 'showMyProfile']);
    });

    /** ---------- 👥 Pacientes públicos (no requieren token) ---------- **/
    Route::get('patients/index', [PatientController::class, 'index']);

    /** ---------- 👥 Clientes (usuarios administrativos u otros) ---------- **/
    Route::get('clients/index', [ClientsController::class, 'index']);

    /** ---------- 📅 Citas ---------- **/
    Route::get('appointments', [AppointmentController::class, 'index']);
    Route::post('appointments', [AppointmentController::class, 'store']);
    Route::delete('appointments/{id}', [AppointmentController::class, 'destroy']);
    Route::get('appointments/pendientes', [AppointmentController::class, 'pendientes']);
    Route::get('appointments/stats', [AppointmentController::class, 'stats']);

    /** ---------- 🩺 Historial Médico ---------- **/
    Route::get('medical-records', [MedicalRecordController::class, 'index']);
    Route::post('medical-records', [MedicalRecordController::class, 'store']);
    Route::get('medical-records/{id}', [MedicalRecordController::class, 'show']);
    Route::delete('medical-records/{id}', [MedicalRecordController::class, 'destroy']);

    /** ---------- 🧾 Historial Extend. (HistorialED) ---------- **/
    Route::get('historialed', [HistorialEDController::class, 'index']);
    Route::post('historialed', [HistorialEDController::class, 'store']);
    Route::get('historialed/{id}', [HistorialEDController::class, 'show']);
    Route::delete('historialed/{id}', [HistorialEDController::class, 'destroy']);

  

});
// Solo para pruebas rápidas
Route::post('/consultas', [ConsultaController::class, 'store']);
Route::get('/consultas', [ConsultaController::class, 'index']);
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
Route::post('/reset-password', [PasswordResetController::class, 'reset']);

