<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarApiController;
use App\Http\Controllers\Payment\PaymentController;

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

//protected route for admins
Route::middleware(['auth','admin'])->group(function(){
Route::apiResource('car', CarApiController::class);
});

//mpesa
Route::post('/mpesa/callback', [PaymentController::class, 'callback'])
    ->name('mpesa.callback');