<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getPriceInHumanAttribute()
    {
        return 'تومان '.number_format($this->price * 100);
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class,'attributes_products');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at','desc');
    }

    public function scopeFilters($query, array $params){

        if(isset($params['price']) && $params['price'] == 1){

           $query->where('price','<',2000);
        }

        if(isset($params['price']) && $params['price'] == 5)
        {
            $query->where('price','>', 5000);
        }

        return $query;
    }
}
