<?php

namespace App\Services\Coupon\ChainValidate;

use App\Models\Coupon;
use App\Services\Coupon\Contract\CouponAbstract;

class HaveCouponCode extends CouponAbstract{


    public function validate($code)
    {
        $couponCode = Coupon::where('coupon_code',$code)->get();

        if(empty($couponCode->all()))
        {
            return back()->with('failed',__('message.your_discount_code_is_not_valid'));
        }

        return $this->goNextValidate($code);

    }

   





}