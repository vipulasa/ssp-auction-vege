<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, string $slug)
    {
        // check if a slug is there
        if (!$slug || strlen($slug) < 2) {
            abort(404);
        }

        // query for the category
        $category = (new ProductCategory())
            ->with([
                'products'
            ])
            ->where('slug', $slug)
            ->first();

        if(!$category){
            abort(404, 'Category Not Found');
        }

        // Query method (BAD BAD WAY)
//         $products = (new Product())
//            ->where('category_id', $category->id)
//            ->get();


        return view('category', [
            'category' => $category,
            'products' => $category->products
        ]);
    }
}
