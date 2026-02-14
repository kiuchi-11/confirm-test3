<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\IndexController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register/step1', [RegisterController::class, 'step1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'postStep1'])->name('register.step1.post');
Route::get('/register/step2', [RegisterController::class, 'step2'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'postStep2'])->name('register.step2.post');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [IndexController::class, 'index'])->name('weight_logs.index');
    Route::get('/weight/create', [WeightLogController::class, 'create'])->name('weight.create');
    Route::get('/weight/{id}/edit', [WeightLogController::class, 'edit'])->name('weight.edit');
    Route::get('/target/edit', [WeightTargetController::class, 'edit'])->name('target.edit');
});