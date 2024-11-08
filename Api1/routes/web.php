<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::get('/post',[PostController::class,'index']);
    Route::get('/post/create',[PostController::class,'create']);
    Route::post('/post/create',[PostController::class,'store']);
});