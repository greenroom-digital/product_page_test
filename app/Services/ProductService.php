<?php 

namespace App\Services;

use App\Exceptions\InvalidProductException;
use App\Models\Product;

class ProductService
{
    public function show($slug)
    {
        if ($slug !== 'fall-limited-edition-sneakers') {
            throw new InvalidProductException;
        }

        $product = Product::with(['discount', 'images'])
            ->slug($slug)
            ->firstOrFail();

        return $product;
    }
}