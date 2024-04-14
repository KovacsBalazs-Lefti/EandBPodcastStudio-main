<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FoglalasController;
use App\Http\Controllers\API\SzolgaltatasokController;

Route::get('/user', function (Request $request) {
    $user = $request->user();
    //objektum módosítás
    //$user['alma']= "sajt";

    //kiveszünk adatot a tömbből
    unset($user['jelszo_megerositese']);

    return $user;
})->middleware('auth:sanctum');

//regisztráció login logut post hívása
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('/logout-logoutEverywhere',[AuthController::class,'logoutEverywhere'])->middleware('auth:sanctum');

Route::apiResource('/foglalas', FoglalasController::class)->middleware('auth:sanctum');
Route::apiResource('/szolgaltatasok', SzolgaltatasokController::class)->middleware('auth:sanctum');

