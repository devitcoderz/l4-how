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
    Route::get('/patient/{patient}/documents', [AdminDashboardController::class, 'selectedPatientDocuments'])->name('dashboard.docs');
    Route::post('/patient/{patient}/documents/upload', [AdminDashboardController::class, 'uploadDocument'])->name('dashboard.docs.upload');
    Route::post('/patient/documents/upload/ajax', [AdminDashboardController::class, 'uploadDocumentAjax'])->name('dashboard.docs.upload.ajax');
    Route::delete('/patient/{patient}/document/{document}/delete', [AdminDashboardController::class, 'deleteDocument'])->name('dashboard.docs.delete');
    
    // User Management Routes
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [UserController::class, 'store'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');
   
    Route::get('/change-password',[AdminDashboardController::class,'change_password'])->name('change-password');
    Route::post('/change-password',[AdminDashboardController::class,'change_password_submit'])->name('change-password.submit');
});

Route::middleware(['auth','auth.user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserDashboardController::class,'index'])->name('dashboard');
    
    // Change Password Routes
    Route::get('/change-password',[UserDashboardController::class,'change_password'])->name('change-password');
    Route::post('/change-password',[UserDashboardController::class,'change_password_submit'])->name('change-password.submit');
});

