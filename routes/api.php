<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\StudentController;
use Illuminate\Auth\Events\Login;

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

Route::prefix('/students')->group(function () {
    Route::get('', [StudentController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [StudentController::class, 'getById']);
    Route::post('', [StudentController::class, 'create']);
    Route::middleware('validate.id')->delete('/{id}', [StudentController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [StudentController::class, 'modify']); 
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/sign-up', [LoginController::class, 'signUp']);
Route::get('/no-login', [LoginController::class, 'withoutLogin']);
Route::middleware('auth:api')->get('/me', [LoginController::class, 'whoAmI']);
Route::middleware('auth:api')->get('/logout', [LoginController::class, 'logout']);