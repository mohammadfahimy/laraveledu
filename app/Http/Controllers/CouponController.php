<?php

namespace App\Http\Controllers;

use App\Services\Coupon\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CouponController extends Controller
{
    
    public function store(Request $request)
    {
        $coupon = new Coupon;
        if($coupon->validate($request->couponcode) === true){

            return $coupon->calculateTotalBasket($request->couponcode);
            
        }
        return $coupon->validate($request->couponcode);
    }
}
