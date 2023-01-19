<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use App\Services\Basket\Basket;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    
    public function index(Request $request,Product $product)
    {
        return view('frontend.product.detail',compact('product'));
    }

    
}
