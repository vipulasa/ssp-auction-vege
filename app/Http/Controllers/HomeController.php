<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products = (new Product())->get();

        return view('home', [
            'products' => $products,
        ]);
    }
}
