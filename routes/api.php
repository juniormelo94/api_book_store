<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
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

Route::get('/unauthorized', function () {
    return response()->json([
        "status" => "error",
        "message" => "unauthorized"
    ], 401);
})->name('unauthorized');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

Route::controller(BookController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/books', 'index');
    Route::post('/books', 'store');
    Route::get('/books/{id}', 'show');
    Route::put('/books/{id}', 'update');
    Route::delete('/books/{id}', 'destroy');
});
