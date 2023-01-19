<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $images = Image::all()->where('imageable_type','App\Models\Image');
        
        $products = Product::all();
        // return view('frontend.index.index',compact('products'));
    }

    public function test(Request $request)
    {
        dd($request->product_id);
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        // $todo = Todo::create($data);
        // return Response::json($todo);
    }
}
