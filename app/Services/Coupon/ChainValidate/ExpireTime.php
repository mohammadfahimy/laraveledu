<?php
namespace App\Services\Coupon\ChainValidate;

use App\Models\Coupon;
use App\Services\Coupon\Contract\CouponAbstract;

class expireTime extends CouponAbstract{



    public function validate($code)
    {

        $Coupon = Coupon::where('coupon_code', $code)->first();        
        $expire = $Coupon->coupon_expire;
        $nowDay   =  date("Y-m-d");

        if($expire != $nowDay)
        {
            return $this->goNextValidate($code);
        }

        return back()->with('failed',__('message.Your_Coupon_is_expired'));

    }

    
    
}