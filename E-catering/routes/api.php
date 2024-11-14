<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\FavoritController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//API Product
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

// API Favorit
Route::get('/favorit', [FavoritController::class, 'index']);
Route::get('/favorit/{id}', [FavoritController::class, 'show']);
Route::post('/favorit-create', [FavoritController::class, 'store']);
Route::delete('/favorit/{id}', [FavoritController::class, 'destroy']);