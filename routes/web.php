<?php

use App\Events\TestEvent;
use App\Events\TestPrivateEvent;
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

Route::get("/websocket", function () {
    // PUBLIC CHANNEL EVENT
    // event(new TestEvent("All is well"));

    // PRIVATE CHANNEL EVENT
    // event(new TestPrivateEvent("Do my ID have access to this channel?", 1));

    // return "OK";
    return view("websocket");
});

Route::get("/websocket-listen", function () {
    // WEBSOCKET
    // 1. php artisan install:broadcasting
    // 2. php artisan make:event testingEvent
    // 

    // to RUN websocket
    // php artisan reverb:start
    // php artisan queue:work (NEEDED TO RUN QUEUE)

    // contains JS needed to listen to websocket!
    return view("websocket-listen");
});
