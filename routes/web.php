<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/products', [ProductsController::class, 'showAll']);


Route::get('/products/{id}', [ProductsController::class, 'show']);

Route::get('/', function () {
    return response()->json([
      'status' => 200,
      'message' => 'Fullstack Challenge 20201026',
    ]);
  });
  