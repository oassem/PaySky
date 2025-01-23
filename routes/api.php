<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/orders', [OrderController::class, 'create']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::patch('/orders/{id}/payment', [PaymentController::class, 'updateStatus']);
