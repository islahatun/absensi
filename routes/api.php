<?php

use App\Http\Controllers\Api\AttandenceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\IzinController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logOut'])->middleware('auth:sanctum');
Route::post('/checkIn',[AttandenceController::class,'checkIn'])->middleware('auth:sanctum');
Route::post('/checkOut',[AttandenceController::class,'checkOut'])->middleware('auth:sanctum');
Route::get('/isCheckedIn',[AttandenceController::class,'isCheckedIn'])->middleware('auth:sanctum');
Route::get('/isCheckedOut',[AttandenceController::class,'isCheckedOut'])->middleware('auth:sanctum');
Route::post('/updateProfile',[AuthController::class,'updateProfile'])->middleware('auth:sanctum');
Route::post('/izin',[IzinController::class,'izin'])->middleware('auth:sanctum');
Route::get('/getNote',[NoteController::class,'getNote'])->middleware('auth:sanctum');
Route::post('/createNote',[NoteController::class,'createNote'])->middleware('auth:sanctum');

