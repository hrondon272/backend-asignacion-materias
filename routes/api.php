<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LoginController;
// use App\Http\Controllers\api\AsignaturaController;
// use App\Http\Controllers\api\EstudianteController;
// use App\Http\Controllers\api\ProfesorController;
// use App\Http\Controllers\api\AsignacionController;

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

// Para iniciar sesión
Route::post('userLogin', [LoginController::class, 'login']);

// Para verificar el estado de la sesión
Route::get('checkSession', [LoginController::class, 'verifySession']);

// Para renderizar la vista en el caso de que no esté logueado quien intente hacer la petición
Route::get('login', [LoginController::class, 'index'])->name('login');

// Para la autenticación se utilizó sanctum, por medio de tokens
Route::middleware(['auth:sanctum'])->group(function () {

    // Obtener información
    // Route::resource('estudiante', EstudianteController::class);
    // Route::resource('profesore', ProfesorController::class);
    // Route::resource('asignatura', AsignaturaController::class);
    // Route::resource('asignacion', AsignacionController::class);
    Route::post('userLogout', [LoginController::class, 'logout']);
});
