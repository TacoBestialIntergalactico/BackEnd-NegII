<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\UserAuthentication;
use App\Http\Controllers\CartController;


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
Route::get('/ShowProduct/{id}', [ProductsController::class,'show']);
Route::get('/indexShopping/{id}', [ShoppingController::class, 'index']);

Route::post('/storeCategory', [CategoryController::class, 'store']);
Route::post('/storeProducts', [ProductsController::class, 'store']);
Route::post('/storeShopping', [ShoppingController::class, 'store']);

Route::post('/update/{id}/updateProduct', [ProductsController::class, 'update']);

Route::post('/destroyCategory', [CategoryController::class, 'destroy']);
Route::post('/destroyProducts/{id}', [ProductsController::class, 'destroy']);
Route::post('/destroyShopping', [ShoppingController::class, 'destroy']);


//user
Route::get('/indexUser', [UserAuthentication::class, 'index']);
Route::post('/login', [UserAuthentication::class, 'login']);

Route::post('/UserRegister', [UserAuthentication::class, 'storeRegister']);



Route::middleware('auth:api')->get('/User', [UserAuthentication::class, 'User']);

//ShoppingCart
Route::post('/addToCart', [CartController::class, 'addToCart']);
Route::get('/Cart/{userId}/products', [CartController::class, 'getCartProducts']);
Route::delete('/Cart/{cartId}/delete', [CartController::class, 'removeProductFromCart']);
Route::post('/moveCartsToShoppings', [CartController::class, 'moveCartsToShoppings']);

