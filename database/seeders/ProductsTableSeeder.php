<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Insert product
        $productId = DB::table('products')->insertGetId([
            'name' => 'Fall Limited Edition Sneakers',
            'description' => "These low-profile sneakers are your perfect casual wear companion. Featuring a durable rubber outer sole, they'll withstand everything the weather can offer.",
            'slug' => Str::slug('Fall Limited Edition Sneakers'),
            'price' => 250,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert product images
        DB::table('product_images')->insert([
            ['product_id' => $productId, 'path' => 'image-product-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => $productId, 'path' => 'image-product-2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => $productId, 'path' => 'image-product-3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => $productId, 'path' => 'image-product-4.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert product discount
        DB::table('product_discounts')->insert([
            'product_id' => $productId,
            'type' => 'percent',
            'discount' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
