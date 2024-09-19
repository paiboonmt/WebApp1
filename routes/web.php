<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FighterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[DashboardController::class ,'index'])->name('dashboard');

    Route::get('/users',[UserController::class,'index'])->name('users');
    Route::get('/fighters',[FighterController::class,'index'])->name('fighters');
    Route::get('/fighter_show/{id}',[FighterController::class,'show'])->name('fighter_show');
    Route::get('/customers',[CustomerController::class,'index'])->name('customers');
    Route::get('/customer_show/{id}',[CustomerController::class,'show'])->name('customer_show');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
