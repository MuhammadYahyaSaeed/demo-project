<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;




// Auth::routes();

// Cart Routes
Route::middleware(['Auth'])->group(function () {
    Route::post('/cart/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartId}', [CartController::class, 'remove'])->name('cart.remove');
});


Route::resource('restaurants', RestaurantController::class);
Route::resource('restaurants.products', ProductController::class);

Route::get('/', function () {
    return view('home');
})->name('home');

// Menu route
Route::get('/menu', function () {
    return view('menu');
})->name('menu');








//Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
// Route::get('/', [HomeController::class, 'index']);



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
