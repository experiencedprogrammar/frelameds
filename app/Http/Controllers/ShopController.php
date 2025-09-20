<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Show all products for customers (frontend shop page).
     */
    
        public function index()
       {
         $products = Product::where('is_active', 1)
                       ->orderBy('created_at', 'desc')
                       ->paginate(12); // 12 items per page -> 4 per row (col-lg-3)
         return view('frontend.shop', compact('products'));
    }

      
    /**
     * Show a single product detail page.
     */
     public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('frontend.shop.show', compact('product'));
    }
}
