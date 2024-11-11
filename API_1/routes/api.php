<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


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
Route::get('/post',[PostController::class,'index']);
Route::get('/post/create',[PostController::class,'create']);
Route::post('/post/create',[PostController::class,'store']);
Route::put('/post/edit/{post}',[PostController::class,'update']);
Route::delete('/post/delete/{post}',[PostController::class,'destroy']);
Route::get('/post/{post}',[PostController::class,'show']);
Route::get('/post/{post}/edit',[PostController::class,'edit']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
