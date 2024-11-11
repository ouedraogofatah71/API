<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

//Route pour user
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
    //Retourne les information de l'utilisateur connecter
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/post',[PostController::class,'index']);
    Route::get('/post/create',[PostController::class,'create']);
    Route::get('/post/{post}',[PostController::class,'show']);
    Route::get('/post/{post}/edit',[PostController::class,'edit']);
    Route::post('/post/create',[PostController::class,'store']);
    Route::put('/post/edit/{post}',[PostController::class,'update']);
    Route::delete('/post/delete/{post}',[PostController::class,'destroy']);
});
