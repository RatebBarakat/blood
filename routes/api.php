<?php

use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SocialLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\LoginController;
use Laravel\Sanctum\PersonalAccessToken;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('admin')->group(function (){
    Route::post('/login',[LoginController::class,'Adminlogin']);
});
Route::prefix('user')->group(function (){
    Route::post('/login',[LoginController::class,'Userlogin']);
});

Route::get('/dash',function (){
    return response()->json('im authorize');
})->middleware(['auth:sanctum']);

Route::middleware(['auth:sanctum','api.admin'])->group(function (){
    Route::apiResource('/users',UserController::class);
});

Route::middleware('auth:sanctum')->prefix('user')->name('user.')->group(function (){
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::post('/update',[ProfileController::class,'update'])->name('update');
        Route::apiResource('',ProfileController::class)->only('index');
    });

    Route::name('appointment.')->group(function () {
        Route::apiResource('/appointment',AppointmentController::class);
    });
});
