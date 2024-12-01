<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get("/logout",[AuthenticationController::class,'logout'])->name("logout");
Route::group(['middleware' => 'guest'], function () {
    Route::get("/login",[AuthenticationController::class,'login'])->name("login");
    Route::post("/login",[AuthenticationController::class,'login_submit'])->name("login.submit");
    Route::get("/register",[AuthenticationController::class,'register'])->name("register");
    Route::post("/register",[AuthenticationController::class,'register_submit'])->name("register.submit");
});

Route::middleware(['auth','auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',[AdminDashboardController::class,'index'])->name("dashboard");
    Route::get("/settings",[AdminDashboardController::class,'settings'])->name('settings');
    Route::post("/settings",[AdminDashboardController::class,'save_settings'])->name('save-settings');
    
  
    Route::get('/change-password',[AdminDashboardController::class,'change_password'])->name('change-password');
    Route::post('/change-password',[AdminDashboardController::class,'change_password_submit'])->name('change-password.submit');
});

Route::middleware(['auth','auth.user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserDashboardController::class,'index'])->name('dashboard');
    
    // Change Password Routes
    Route::get('/change-password',[UserDashboardController::class,'change_password'])->name('change-password');
    Route::post('/change-password',[UserDashboardController::class,'change_password_submit'])->name('change-password.submit');
});

