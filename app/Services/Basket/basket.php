<?php
namespace App\Services\Basket;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class Basket{

    private $minutes = 100;

    public function addToBasket(Product $product, $request)
    {
        
        
        $basket = json_decode(Cookie::get('basket'),true);

        if(!$basket){

            $basket = [
                $product->id => [
                    'name' => $product->title,
                    'price'=> $product->price,
                    'image' => $product->thumbnail_url,
                    'quantity' => $request->quantity,
                    'attribute' => $request->attribute,
                    'totalbasket' => $product->price * $request->quantity
                ]
            ];

            Cookie::queue('basket', json_encode($basket), $this->minutes);

            return back()->with('success',__('message.product_added_to_basket'));

        }

        if(array_key_exists($product->id, $basket)){

            if($basket[$product->id]['quantity'] == $request->quantity)
            {
                return back()->with('failed',__('message.this_product_has_already_in_basket'));
            }

            $basket[$product->id]['quantity'] = $request->quantity;

        }

        $basket[$product->id] = [
            'name'        => $product->title,
            'price'       => $product->price,
            'image'       => $product->thumbnail_url,
            'quantity'    => $request->quantity,
            'attribute'   => $request->attribute,
            'totalbasket' => $product->price * $request->quantity
        ];
        Cookie::queue('basket', json_encode($basket), $this->minutes);

        
        return back()->with('success',__('message.product_added_to_basket'));
    }



    public static function getCountBasket()
    {
        $baskets = !is_null(json_decode(Cookie::get('basket'),true)) ? json_decode(Cookie::get('basket'),true) : [];

        $newBasket = [];

        foreach($baskets as $key => $basket){

            if(is_int($key)){

                $newBasket [$key] = $basket;
            }
        }

        return !empty($newBasket) ? count($newBasket): 0 ;
    }

    public static function getTotalBasket()
    {
        $basket =  json_decode(Cookie::get('basket'),true);

        if(!is_null($basket)){

            return array_sum(array_column($basket,'totalbasket'));

        }

        return false;
    }

    public static function getProductAttribute()
    {
        $basket =  json_decode(Cookie::get('basket'),true);

        if(!is_null($basket))
        {
            $attributes = array_column($basket,'attribute');
            
        }
    }

    public function removeOnBasket($product_id)
    {
        $basket =  json_decode(Cookie::get('basket'),true);

        if (array_key_exists($product_id, $basket)) {

            unset($basket[$product_id]);

            Cookie::queue('basket', json_encode($basket), $this->minutes);
        
            return back()->with('success',__('message.product_was_deleted_from_basket'));
        }

        return back()->with('failed',__('message.this_product_is_not_here'));
        
        
    }

    
    

}