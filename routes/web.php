<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SuppliersController;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/expired', function () {
    return view('layout.expired'); // layout.expired view dosyasına yönlendirilir
})->name('expired');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin_dashboard');
    Route::resource('supplier', SuppliersController::class);

    
});


