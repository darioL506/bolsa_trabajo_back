<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AreaController;

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

Route::group(['middleware' => 'auth:api'], function () {
    // Rutas para ofertas
    Route::get('offers', [OfferController::class, 'index']); // Devuelve todas las ofertas
    Route::get('offers/{id}', [OfferController::class, 'indexById']); // Devuelve una oferta
    Route::get('offersbyid/{id}', [OfferController::class, 'index']); // Devuelve todas las ofertas de una compañia en concreto
    Route::get('offers/{offer}', [OfferController::class, 'show']); // Devuelve una oferta
    Route::post('offers', [OfferController::class, 'store']); // Guarda una nueva oferta
    Route::put('offers/{offer}', [OfferController::class, 'update']); // Acualiza oferta
    Route::delete('offers/{offer}', [OfferController::class, 'delete']); // Elimina oferta

    // Rutas para compañias
    Route::get('companyId/{user_id}', [CompanyController::class, 'getCompanyId']); // Devuelve una compañia

    //Rutas alumno
    Route::put('student/{user_Id}', [StudentController::class, 'updateStudent']); //Actualiza un alumno
    Route::get('offersActive', [OfferController::class, 'activeOffers']); // Devuelve todas las ofertas activas
});
// Rutas para Areas
Route::get('areas', [AreaController::class, 'index']); // Devuelve todas las areas

Route::put('offers/active/{id}', [OfferController::class, 'activeOffer']); // Activa oferta
Route::put('offers/desactive/{id}', [OfferController::class, 'desactiveOffer']); // Desactiva oferta

Route::post('student/insert', [StudentController::class, 'insertStudents']);
Route::delete('student/delete/{student}', [StudentController::class, 'deleteStudent']);
Route::get('student/get-all', [StudentController::class, 'getAll']);
Route::get('student/{user_Id}', [StudentController::class, 'get']);

Route::post('company/insert', [CompanyController::class, 'insertCompany']);
