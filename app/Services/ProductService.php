<?php 

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function show($slug)
    {
        if ($slug !== 'fall-limited-edition-sneakers') {
            return false;
        }

        $product = Product::with(['discount', 'images'])
            ->slug($slug)
            ->firstOrFail();

        return $product;
    }
}