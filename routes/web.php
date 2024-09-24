<?php
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FighterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard',[DashboardController::class ,'index'])->name('dashboard');
    Route::get('/fighters',[FighterController::class,'index'])->name('fighters');
    // route('fighter_show')
    Route::get('/fighter_show/{id}',[FighterController::class,'show'])->name('fighter_show');
    // route('fighter_create)
    Route::get('/fighter_create',[FighterController::class,'create'])->name('fighter_create');
    // route('fighter_save')
    Route::post('/fighter_save',[FighterController::class,'store'])->name('fighter_save');
    // customers
    // route('customers')
    Route::get('/customers',[CustomerController::class,'index'])->name('customers');
    // route('customer_show')
    Route::get('/customer_show/{id}',[CustomerController::class,'show'])->name('customer_show');

    // route('manage')
    Route::get('/manage',[ManageController::class,'index'])->name('manage');
    // route('user_update')
    Route::post('/user_update/{id}',[UserController::class,'update'])->name('user_update');

    // Cart
    Route::get('/ticket',[CartController::class,'index'])->name('ticket');

    Route::post('/addToCart',[CartController::class,'addToCart'])->name('addToCart');
    Route::put('/updateCart', [CartController::class, 'updateCart'])->name('updateCart');
    Route::post('/cartremove', [CartController::class, 'remove'])->name('cartremove');
    Route::get('/cart_checkout', [CartController::class, 'checkout'])->name('cart_checkout');


});


