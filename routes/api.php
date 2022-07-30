<?php

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorClinicController;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DiagnsisController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\MedicineController;
use App\Http\Middleware\apiAuth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function($router) {
    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [JWTController::class, 'login']);
    Route::post('/logout', [JWTController::class, 'logout']);
    Route::post('/refresh', [JWTController::class, 'refresh']);
    Route::post('/profile', [JWTController::class, 'profile']);
    Route::get('/profileById/{user_id}', [JWTController::class, 'profileById']);
});


Route::get('/Doctors',[DoctorController::class, 'index']);
Route::get('/Doctors/{id}',[DoctorController::class, 'show']);
Route::post('/Doctors',[DoctorController::class, 'store']);
Route::put('/Doctors/{id}',[DoctorController::class, 'update']);
Route::delete('/Doctors/{id}',[DoctorController::class, 'destroy']);


Route::get('/receptionists',[ReceptionistController::class, 'index']);
Route::get('/receptionists/{id}',[ReceptionistController::class, 'show']);
Route::post('/receptionists',[ReceptionistController::class, 'store']);
Route::put('/receptionists/{id}',[ReceptionistController::class, 'update']);
Route::delete('/receptionists/{id}',[ReceptionistController::class, 'destroy']);

Route::get('/Patients',[PatientController::class, 'index']);
Route::get('/Patients/{id}',[PatientController::class, 'show']);
Route::post('/Patients',[PatientController::class, 'store']);
Route::put('/Patients/{id}',[PatientController::class, 'update']);
Route::delete('/Patients/{id}',[PatientController::class, 'destroy']);
Route::get('/getPatientName',[PatientController::class, 'getPatientName']);
Route::get('/getPatient/{id}',[PatientController::class, 'getPatient']);

Route::get('/Appointments',[AppointmentController::class, 'index']);
Route::get('/Appointments/{id}',[AppointmentController::class, 'show']);
Route::post('/Appointments',[AppointmentController::class, 'store']);
Route::put('/Appointments/{id}',[AppointmentController::class, 'update']);
Route::delete('/Appointments/{id}',[AppointmentController::class, 'destroy']);

Route::get('/Diagnsises',[DiagnsisController::class, 'index']);
Route::get('/Diagnsises/{id}',[DiagnsisController::class, 'show']);
Route::post('/Diagnsises',[DiagnsisController::class, 'store']);
Route::put('/Diagnsises/{id}',[DiagnsisController::class, 'update']);
Route::delete('/Diagnsises/{id}',[DiagnsisController::class, 'destroy']);

Route::get('/Medicines',[MedicineController::class, 'index']);
Route::get('/Medicines/{id}',[MedicineController::class, 'show']);
Route::post('/Medicines',[MedicineController::class, 'store']);
Route::put('/Medicines/{id}',[MedicineController::class, 'update']);
Route::delete('/Medicines/{id}',[MedicineController::class, 'destroy']);

Route::get('/Visits',[VisitController::class, 'index']);
Route::get('/Visits/{id}',[VisitController::class, 'show']);
Route::post('/Visits',[VisitController::class, 'store']);
Route::put('/Visits/{id}',[VisitController::class, 'update']);
Route::get('/getPatientVisit/{id}',[VisitController::class, 'getPatientVisit']);

