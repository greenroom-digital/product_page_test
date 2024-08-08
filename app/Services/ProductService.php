<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{
    public function calculateDiscountedPrice(Product $product): float
    {
        if (!$product->discount) {
            return $product->price;
        }

        $discount = $product->discount;
        if ($discount->type === 'percent') {
            return $product->price * (1 - $discount->discount / 100);
        } elseif ($discount->type === 'amount') {
            return $product->price - $discount->discount;
        }

        return $product->price;
    }

    public function formatProductResponse(Product $product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'slug' => $product->slug,
            'price' => [
                'full' => $product->price,
                'discounted' => $this->calculateDiscountedPrice($product),
            ],
            'discount' => $product->discount ? [
                'type' => $product->discount->type,
                'amount' => $product->discount->discount,
            ] : null,
            'images' => $product->images->pluck('path'),
        ];
    }
}
