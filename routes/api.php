<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AreaController;
use Laravel\Passport\Passport;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Métodos
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['cors'])->group(function () {
    Route::put('offers/active/{id}', [OfferController::class, 'activeOffer']); // Activa oferta
    Route::put('offers/desactive/{id}', [OfferController::class, 'desactiveOffer']); // Desactiva oferta
    Route::get('offersbyid/{id}', [OfferController::class, 'index']); // Devuelve todas las ofertas de una compañia en concreto

    Passport::routes();
});

Route::middleware(['auth:api'])->group(function () {
    // Rutas para ofertas
    Route::get('offers', [OfferController::class, 'index']); // Devuelve todas las ofertas
    Route::get('offers/{id}', [OfferController::class, 'indexById']); // Devuelve una oferta
    Route::get('offers/{offer}', [OfferController::class, 'show']); // Devuelve una oferta
    Route::post('offers', [OfferController::class, 'store']); // Guarda una nueva oferta
    Route::put('offers/{offer}', [OfferController::class, 'update']); // Acualiza oferta
    Route::delete('offers/{offer}', [OfferController::class, 'delete']); // Elimina oferta


    // Rutas para compañias
    Route::get('company/{user_id}', [CompanyController::class, 'getCompany']);
    //Rutas alumno
    Route::put('student/{user_Id}', [StudentController::class, 'updateStudent']);
    Route::delete('student/delete/{student}', [StudentController::class, 'deleteStudent']);
    Route::get('student/get-all', [StudentController::class, 'getAll']);
});

// Rutas para Areas
Route::get('areas', [AreaController::class, 'index']); // Devuelve todas las areas

//Rutas para alumno
Route::post('student/insert', [StudentController::class, 'insertStudents']);
Route::get('student/{user_Id}', [StudentController::class, 'get']);
//Rutas para empresa
Route::post('company/insert', [CompanyController::class, 'insertCompany']);
