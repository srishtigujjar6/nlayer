<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\CategoriesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Product apis 
Route::get('/product_list', [ProductsController::class,'getproducts']);
Route::post('/product_store', [ProductsController::class,'product_store']);
Route::post('/product_update/{product}', [ProductsController::class,'product_update']);
Route::post('/product_destroy/{product}', [ProductsController::class,'product_destroy']);
Route::get('/product_view/{product}', [ProductsController::class,'product_view']);

// color apis 
Route::get('/color_list', [ColorsController::class,'getcolors']);
Route::post('/color_store', [ColorsController::class,'color_store']);
Route::post('/color_update/{color}', [ColorsController::class,'color_update']);
Route::post('/color_destroy/{color}', [ColorsController::class,'color_destroy']);
Route::post('/color_view/{color}', [ColorsController::class,'color_view']);

// category apis 
Route::get('/category_list', [CategoriesController::class,'getcategories']);
Route::post('/category_store', [CategoriesController::class,'category_store']);
Route::post('/category_update/{category}', [CategoriesController::class,'category_update']);
Route::post('/category_destroy/{category}', [CategoriesController::class,'category_destroy']);
Route::post('/category_view/{category}', [CategoriesController::class,'category_view']);

// getException 
Route::get('/getException', [ProductsController::class,'getException']);
Route::get('/getHandlerException', [ProductsController::class,'getHandlerException']);