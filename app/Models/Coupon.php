<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $fillable = ['coupon_code','coupon_name','coupon_percentage','coupon_time','coupon_description','coupon_expire'];
}
