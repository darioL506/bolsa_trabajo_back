<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\StudentController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => 'auth:api'], function() {
    // Rutas para ofertas
    Route::get('offers', [OfferController::class, 'index']);

    
    //Route::get('articles/{article}', [ArticleController::class, 'show']);
    //Route::post('articles', [ArticleController::class, 'store']);
    //Route::put('articles/{article}', [ArticleController::class, 'update']);
    //Route::delete('articles/{article}', [ArticleController::class, 'delete']);
});

Route::post('student/insert',[StudentController::class,'insertStudents']);
Route::put('student/{student}', [StudentController::class, 'updateStudents']);
Route::delete('student/{student}', [StudentController::class, 'deleteStudent']);
Route::get('student/all',[StudentController::class, 'getAll']);