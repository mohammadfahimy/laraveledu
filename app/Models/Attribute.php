<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class,'attributes_products');
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }
}
