<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route ::get('orders',[OrdersController::class,'index']);
route ::post('orders',[OrdersController::class,'store']);
route ::get('orders/{id}',[OrdersController::class,'show']);
route ::post('orders/{id}',[OrdersController::class,'show']);
route ::post('orders/{id}/edit',[OrdersController::class,'edit']);
route ::put('orders/{id}/edit',[OrdersController::class,'update']);
route ::delete('orders/{id}/delete',[OrdersController::class,'destroy']);
route ::post('orders/{id}/add',[OrdersController::class,'addProduct']);
route:: post('orders/{id}/pay',[OrdersController::class,'payProduct']);
