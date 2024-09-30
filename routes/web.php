<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [AdController::class, 'index'])->name('home');
Route::post('/search', [SearchController::class, 'index'])->name('search');
Route::get('/ads/create', [AdController::class, 'show_ad'])->name('show.ad');
Route::post('/ads/create', [AdController::class, 'store'])->name('create.ad');
Route::get('/ad/save', [UserController::class, 'save_ad'])->name('save.ad');
Route::get('/ad/lose', [UserController::class, 'lose_ad'])->name('lose.ad');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
