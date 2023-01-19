<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    
    public function index()
    {

        $images = Image::all()->where('imageable_type','App\Models\Image');
        
        $products = Product::all();

        return view('frontend.index.index',compact('images','products'));
    }

    public function ajaxRequestPost(request $request)
    {
        dd($request->all());
    }

    

}
