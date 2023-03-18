<?php

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

//API route for register new user
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
//API route for email registration activation
Route::get('/emailReg/{emailToken}', [App\Http\Controllers\AuthController::class, 'setActiveUser']);
//API route for password remember
Route::post('/forgotPassword', [App\Http\Controllers\AuthController::class, 'forgotPassword']);

///////////PROTECTED ROUTES AUTH
Route::group(['middleware' => ['auth:sanctum']], function () {
// API route for logout user
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});
///////////END OF PROTECTED ROUTES AUTH
