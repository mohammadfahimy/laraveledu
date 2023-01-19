<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Basket\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class BasketController extends Controller
{
    private $minutes = 100;
    private $basket ;

    public function __construct()
    {
        $this->basket = new Basket();
    }

    public function index()
    {
        $basket = json_decode(Cookie::get('basket'),true);
        
        if(is_null($basket) || empty($basket)){

            return view('frontend.product.empty_basket');
        }
        return view('frontend.product.basket', compact('basket'));
    }

    public function addToBasket(Request $request, $productId)
    {
       $product =  Product::find($productId);

        return $this->basket->addToBasket($product, $request);

    }

    public function remove($basket_id)
    {
        return $this->basket->removeOnBasket($basket_id);
    }
}
