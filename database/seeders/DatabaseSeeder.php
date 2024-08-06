<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductDiscount;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        
        $product = Product::create([
            "name" => "Fall Limited Edition Sneakers",
            "description" => "These low-profile sneakers are your perfect casual wear companion. Featuring a durable rubber outer sole, they'll withstand everything the weather can offer.",
            "slug" =>  "fall-limited-edition-sneakers",
            "price" => 250,
            "active" => 1,
        ]);


        $imagePaths = [
            "image-product-1.jpg",
            "image-product-2.jpg",
            "image-product-3.jpg",
            "image-product-4.jpg",
        ];

        $data = [];
        foreach ($imagePaths as $img) {
            $data[] =  [
                "product_id" => $product->id,
                "path" => $img,
                "created_at" => $now,
                "updated_at" => $now,
            ];
        }

        ProductImage::insert($data);

        ProductDiscount::create([
            "product_id" => $product->id,
            "type" => "percent",
            "discount" => 50,
        ]);
    }
}
