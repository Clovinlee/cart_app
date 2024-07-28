<?php

use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\FormController;
use App\Http\Controllers\Api\v1\MailController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\WebsocketController;
use App\Http\Middleware\TestMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('products', ProductController::class);
Route::group(['prefix' => 'v1', 'namespace' => 'Api\Http\Controllers\Api\v1'], function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put("/products/{id}", [ProductController::class, "update"]);
    Route::patch("/products/{id}", [ProductController::class, "update"]);
    Route::post("/products", [ProductController::class, "store"]);
    Route::delete("/products/{id}", [ProductController::class, "destroy"]);

    Route::post("/cart", [CartController::class, "store"]);

    Route::post("/form", [FormController::class, "index"]);

    // TESTING COOKIE HTTPONLY
    Route::get("/test", [TestController::class, "index"])->middleware(TestMiddleware::class);
    Route::get("/testcookie", [TestController::class, "setCookie"]);
    Route::get("/getcookie", [TestController::class, "getCookie"]);

    // TESTING WORKER & QUEUE
    Route::prefix("/mail")->group(function () {
        Route::get("/send", [MailController::class, "sendMail"]);
    });

    // TESTING ELASTICSEARCH & REDIS CACHE
    // composer require predis/predis
    // composer require elasticsearch/elasticsearch
    Route::get("/search", [ProductController::class, "search"]);

    // ROUTE FOR WEBSOCKET API
    Route::post("/notify", [WebsocketController::class, "notify"]);
});
