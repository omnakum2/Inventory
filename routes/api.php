<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BrandApiController;
use App\Http\Controllers\Api\ProductApiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("register", [AuthApiController::class, "register"]); 
Route::post("login", [AuthApiController::class, "login"]);

// Protected Routes
Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    
    Route::get("profile", [AuthApiController::class, "profile"]);
    Route::get("logout", [AuthApiController::class, "logout"]);
});

Route::apiResource('category', CategoryApiController::class);
Route::apiResource('brand', BrandApiController::class);
Route::apiResource('product', ProductApiController::class);

Route::controller(App\Http\Controllers\Api\NewInvoiceApiController::class)->group(function(){
   Route::get('getProduct','getProduct') ;
});