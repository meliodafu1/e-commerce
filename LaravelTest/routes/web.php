<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/',[TestController::class,'home'])->name('login');
Route::get('/read',[TestController::class,'getId'])->name('read');
Route::get('/store',[TestController::class,'store'])->name('store');
Route::get('/product/{id}',[TestController::class,'product'])->name('product');
Route::get('/getCart',[TestController::class,'cCart'])->name('cartt');
Route::get('/cartProducts',[TestController::class,'cart_products'])->name('cart.products');
Route::get('/editProduct',[TestController::class,'edit_product'])->name('editProduct');
Route::get('/focusout',[TestController::class,'focusout'])->name('focusout');
Route::get('/login',[TestController::class,'login'])->name('user.login');
Route::get('/register',[TestController::class,'register'])->name('user.register');
Route::get('/login-attempt',[TestController::class,'login_user'])->name('login_user');
Route::get('/logout',[TestController::class,'logout'])->name('logout');
Route::get('/removeCart',[TestController::class,'removeCart'])->name('remove-cart');




?>
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
