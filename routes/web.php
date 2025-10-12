<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\DashboardController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/projects/{id}', [HomeController::class, 'projectShow'])->name('projects.show');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Auth Routes
Auth::routes(['register' => false]);

// Admin Routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.redirect');
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Routes
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    
    // Projects Routes
    Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);
    
    // Services Routes
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    
    // 3D Scene Routes
    Route::get('/scene', [App\Http\Controllers\Admin\ThreeSceneController::class, 'index'])->name('scene.index');
    Route::put('/scene', [App\Http\Controllers\Admin\ThreeSceneController::class, 'update'])->name('scene.update');
    Route::get('/scene/settings', [App\Http\Controllers\Admin\ThreeSceneController::class, 'getSettings'])->name('scene.settings');
});
