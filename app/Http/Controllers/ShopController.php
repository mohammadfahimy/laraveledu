<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::filters($request->all())->get();

        // if($request->has('price') && $request->price == 1){
        //    $products =  $products->where('price','<',2000);
        // }

        // if($request->price == 5)
        // {
        //     $products = $products->where('price','>', 5000);
        // }

        return view('frontend.product.shop',compact('products'));
    }

    public function store(Request $request)
    {

    }
}
