<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show all products for customers (frontend home page).
     */
    
        public function home()
       {
         $products = Product::where('is_active', 1)
                       ->orderBy('created_at', 'desc')
                       ->take(12) // limit to 12 items for homepage
                       ->paginate(12); // 12 items per page -> 4 per row (col-lg-3)
                           // get() returns collection of objects
                       
         return view('frontend.home', compact('products'));
    }
      
    
}
