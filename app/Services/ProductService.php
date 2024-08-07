<?php 

namespace App\Services;

use App\Exceptions\InvalidProductException;
use App\Models\Product;

class ProductService
{
    public function show($slug)
    {
        $product = Product::with(['discount', 'images'])
            ->slug($slug)
            ->firstOrFail();

        return $product;
    }
}