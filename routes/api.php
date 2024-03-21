<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShoppingController;

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

Route::get('/indexCategory', [CategoryController::class, 'index']);
Route::get('/indexProducts', [ProductsController::class, 'index']);
Route::get('/indexShopping', [ShoppingController::class, 'index']);

Route::post('/storeCategory', [CategoryController::class, 'store']);
Route::post('/storeProducts', [ProductsController::class, 'store']);
Route::post('/storeShopping', [ShoppingController::class, 'store']);

route::post('/update/{id}/updateProduct',[ProductsController::class, 'update']);
Route::post('/destroyCategory', [CategoryController::class, 'destroy']);
Route::post('/destroyProducts/{id}', [ProductsController::class, 'destroy']);
Route::post('/destroyShopping', [ShoppingController::class, 'destroy']);


