<?php

namespace App\Services\Coupon\Contract;

use App\Services\Coupon\Coupon;

abstract class CouponAbstract{
    
    private $nextValidate;
    

    abstract function validate($code);

    public function  setNextValidate($nextValidate)
    {

        $this->nextValidate = $nextValidate;
    }

    public function goNextValidate($code)
    {

        if($this->nextValidate == null)
        {

            return true;
        }

        return $this->nextValidate->validate($code);
    }
    
}