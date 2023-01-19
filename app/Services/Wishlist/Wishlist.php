<?php

namespace App\Services\Wishlist;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class Wishlist{


    public function ajaxGetProdcut(Request $request){

        $product_id = $request->product_id;

        $haveProduct = Product::find($product_id);

        if(is_null($haveProduct))
        {
            return Response()->json([
                'status' => false,
                'msg' => __('message.This_product_not_define'),
            ],401);
        }

        return $this->processAddToWishlist($haveProduct);
    }

    public function processAddToWishlist(Product $product)
    {
        $wishlist = json_decode(Cookie::get('wishlist'),true);
        if(is_null($wishlist))
        {
            $wishlist = [
                $product->id => [
                    'name'  => $product->title,
                    'image' => $product->thumbnail_url,
                    'price' => $product->price,
                ]
            ];
            Cookie::queue('wishlist',json_encode($wishlist),'100');
            return Response()->json([
                'status' => true,
                'msg'    => __('message.product_added_to_wishlist'),
            ],200);
        }

        if(!$this->productAlreadyWishlistCheck($product->id))
        {
            return Response()->json([
                'status' => false,
                'msg'    => __('message.product_already_in_wishlist'),
            ],401);
        }

        $wishlist[$product->id] = [
            'name' => $product->title,
            'image' => $product->thumbnail_url,
            'price' => $product->price,
        ];

        Cookie::queue('wishlist', json_encode($wishlist), '100');

            return Response()->json([
                
                'status' => true,
                'msg'    => __('message.product_added_to_wishlist'),

            ],200);

    }

    public function productAlreadyWishlistCheck($id)
    {
        $wishlist = json_decode(Cookie::get('wishlist'),true);

        if(array_key_exists( $id, $wishlist)){

            return false;
        }

        return true;
    }

    

}