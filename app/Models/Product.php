<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    /* Auto-append accesor */
    protected $appends = ['discounted_price'];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function discount()
    {
        return $this->hasOne(ProductDiscount::class);
    }

    public function getDiscountedPriceAttribute()
    {
        $this->load(['discount']);

        return ($this->discount->type == 'amount') 
            ? $this->price - $this->discount->discount
            : $this->price - ($this->price * ($this->discount->discount/100));
    }
}
