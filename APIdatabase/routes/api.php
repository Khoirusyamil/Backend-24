<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\StudentsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/student', [StudentsController::class, 'index']);
Route::post('/student', [StudentsController::class, 'store']);
Route::put('/student/{id}', [StudentsController::class, 'update']);
Route::delete('/student/{id}', [StudentsController::class, 'destroy']);