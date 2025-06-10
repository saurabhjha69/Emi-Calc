<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmiController;
use App\Http\Controllers\EmiRuleController;
use App\Http\Controllers\TenureController;
use App\Models\EmiRule;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmiController::class, 'form'])->name('emi.form');
Route::post('/calculate', [EmiController::class, 'calculate'])->name('emi.calculate');

Route::get('/login',[AuthController::class, 'loginPage'])->name('login');
Route::post('/login',[AuthController::class, 'login'])->name('login.submit');
Route::post('/logout',[AuthController::class, 'logout'])->name('login.logout');



Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::resource("tenures",TenureController::class);
Route::resource("emi_rules",EmiRuleController::class);
