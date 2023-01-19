<?php

namespace App\Services\Coupon;

use App\Models\Coupon as ModelsCoupon;
use App\Services\Basket\Basket;
use App\Services\Coupon\ChainValidate\HaveCouponCode;
use App\Services\Coupon\ChainValidate\expireTime;
use Illuminate\Support\Facades\Cookie;

class Coupon{


    public function validate($code)
    {
        $haveCoupon = new HaveCouponCode();
        $expireCoupon = new expireTime();

        $haveCoupon->setNextValidate($expireCoupon);
        return $haveCoupon->validate($code);

    }

    public function generateCouponCode()
    {
        
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $couponcode = array(); 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 9; $i++) {
            $n = rand(0, $alphaLength);
            $couponcode[] = $alphabet[$n];
        }
        return implode($couponcode); 
    }

    public function createCouponCode($name='', $percent='', $desc='', $expire=2)
    {
        ModelsCoupon::create([
            'coupon_name' => 'SabathemeisGood',
            'coupon_code' => $this->generateCouponCode(),
            'coupon_percentage' => 10,
            'coupon_time' => $expire,
            'coupon_description' => 'کدتخفیف 20 درصد برای شب یلدا',
            'coupon_expire' => $this->timeExpire($expire),
        ]);

    }

    public function timeExpire($expire)
    {
        $created_at = date('Y-m-d');
        return date('Y-m-d', strtotime($created_at. ' +'.$expire.' days'));
    }

    public function calculateTotalBasket($coupon)
    {
         $basket = json_decode(Cookie::get('basket'),true);

         $totalBasket = filter_var( Basket::getTotalBasket(), FILTER_SANITIZE_NUMBER_INT);

         $percentage =  (int) $this->getPercentage($coupon);

         $basket['totalbasket'] = round($totalBasket - (($totalBasket * $percentage)/100));

         Cookie::queue('basket', json_encode($basket), 100);
         
         return back()->with('success','کد تخفیف اعمال شد'); 

    }

    public function getPercentage($coupon)
    {
        $percentage = ModelsCoupon::where('coupon_code',$coupon)->first();
        return $percentage->coupon_percentage;

    }
}