<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ShopViewController extends Controller
{
    public function index()
    {
        // dd($response);

        // $response = Http::get('https://dog.ceo/api/breeds/list/random/5');
        $response = Http::timeout(60)->get('http://localhost:8001/api/v1/products');
        return view('shop', ["products" => $response['data']]);
    }
}
