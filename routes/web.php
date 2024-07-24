<?php

use App\Http\Controllers\View\ShopViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get("/shop", [ShopViewController::class, "index"])->name('shop');

Route::get('/cart', function () {
    return view('cart');
})->name("cart");

Route::get("/form", function () {
    return view("form-page");
});
