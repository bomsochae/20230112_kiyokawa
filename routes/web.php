<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'])->middleware('auth');
Route::post('/todo/create', [TodoController::class, 'create']);
Route::post('/todo/update', [TodoController::class, 'update']);
Route::post('/todo/delete', [TodoController::class, 'delete']);
Route::get('/todo/find', [TodoController::class, 'find']);
Route::get('/todo/search', [TodoController::class, 'search']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
