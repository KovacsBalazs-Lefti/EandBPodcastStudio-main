<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FoglalasController;
use App\Http\Controllers\API\SzolgaltatasokController;
use App\Http\Controllers\API\userController;

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

//későbbi listázáshoz
Route::get("/szolgaltatasok/all", [SzolgaltatasokController::class, 'all']);
Route::get("/szolgaltatasok/all/id", [SzolgaltatasokController::class, 'show']);

Route::get("/foglalas/all", [FoglalasController::class, 'all']);
Route::get("/foglalas/all/showWithUser", [FoglalasController::class, 'showWithUser']);


Route::apiResource('/foglalas', FoglalasController::class)->middleware('auth:sanctum');
Route::apiResource('/szolgaltatasok', SzolgaltatasokController::class)->middleware('auth:sanctum');

Route::patch('/foglalasok/{user_felhasznaloid}', [FoglalasController::class, 'update'])->middleware('auth:sanctum');

Route::apiResource('/users', userController::class)->middleware('auth:sanctum');
