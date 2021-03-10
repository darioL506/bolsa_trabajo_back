<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AreaController;
use \App\Http\Controllers\InterviewController;
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
    Route::get('offersbyidActive/{id}', [OfferController::class, 'indexActive']); // Devuelve todas las ofertas de una compañia en concreto


    //alumnos
    Route::get('student/get-all', [StudentController::class, 'getAll']);
    Route::get('areas/{user_id}', [StudentController::class, 'getAreas']);
    //Rutas para gestion oferta/alumno
    Route::post('studentOffer', [InterviewController::class, 'newInterview']);
    Route::put('unsubInter/{inter_id}',[InterviewController::class, 'unsubInter']);
    Route::put('unsubAcept/{inter_id}',[InterviewController::class, 'aceptInter']);

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
    Route::get('companyById/{company_id}', [CompanyController::class, 'getCompanyById']);
    Route::get('company/dashboard/{company_id}', [OfferController::class, 'getOffersInterviewCompany']);


    //Rutas alumno
    Route::put('student/{user_Id}', [StudentController::class, 'updateStudent']);
    Route::delete('student/delete/{student}', [StudentController::class, 'deleteStudent']);
    Route::get('offersActive', [OfferController::class, 'activeOffers']); // Devuelve todas las ofertas activas
    Route::get('offersActive/{user_id}', [OfferController::class, 'activeOffersAl']); // Devuelve todas las ofertas activas en las que no se está apuntado
    Route::get('getStudentInterview/{student_id}', [InterviewController::class, 'getStudentInterview']);
    Route::get('offersInterview/{user_id}', [OfferController::class, 'getOffersInterview']);


    //Rutas Admin
    Route::get('user/get-all', [AuthController::class, 'getAll']);
    Route::delete('user/{user_id}', [AuthController::class, 'delete']);
    Route::put('user/{user_id}', [AuthController::class, 'update']);
    Route::put('user/activate/{user_id}', [AuthController::class, 'activate']);
    Route::delete('areas/{area_id}', [AreaController::class, 'delete']);
    Route::post('areas/insert', [AreaController::class, 'newArea']);
    Route::put('areas/{area_id}', [AreaController::class, 'update']);
});

// Rutas para Areas
Route::get('areas', [AreaController::class, 'index']); // Devuelve todas las areas

//Rutas para alumno
Route::post('student/insert', [StudentController::class, 'insertStudents']);
Route::delete('student/delete/{student}', [StudentController::class, 'deleteStudent']);
Route::get('student/get-all', [StudentController::class, 'getAll']);
Route::get('student/{user_Id}', [StudentController::class, 'get']);
//Rutas para empresa
Route::post('company/insert', [CompanyController::class, 'insertCompany']);
