<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MedicineController;
use App\Http\Controllers\API\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::delete('/deleteUser/{user:id}', [AuthController::class, 'deleteUser']);
Route::put('/editUser/{user:id}', [AuthController::class, 'editUser']);
Route::get('/getUser/{user:id}', [AuthController::class, 'getUser']);
Route::get('/logoutUser', [AuthController::class, 'logoutUser']);


Route::post('/registerPatient', [PatientController::class, 'registerPatient']);
Route::post('/loginPatient', [PatientController::class, 'loginPatient']);
Route::delete('/deletePatient/{patient:id}', [PatientController::class, 'deletePatient']);
Route::put('/editPatient/{patient:id}', [PatientController::class, 'editPatient']);
Route::get('/logoutPatient', [AuthController::class, 'logoutPatient']);

Route::post('/addMedicine', [MedicineController::class, 'addMedicine']);
Route::delete('/deleteMedicine/{medicine:id}', [MedicineController::class, 'deleteMedicine']);
Route::put('/editMedicine/{medicine:id}', [MedicineController::class, 'editMedicine']);
Route::get('/getMedicine/{medicine:id}', [AuthController::class, 'getMedicine']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
