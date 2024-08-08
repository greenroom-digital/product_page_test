<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function show(Product $product)
    {
        return response()->json($this->productService->formatProductResponse($product));
    }

    public function showBySlug($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return response()->json($this->productService->formatProductResponse($product));
    }

    public function store(StoreProductRequest $request)
    {
        return $request;
        $product = Product::create($request->only('name', 'description', 'slug', 'price', 'active'));

        if ($request->has('images')) {
            foreach ($request->images as $path) {
                $product->images()->create(['path' => $path]);
            }
        }

        if ($request->has('discount')) {
            $product->discount()->create($request->discount);
        }

        return response()->json(['message' => 'Product created successfully'], 201);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->only('name', 'description', 'slug', 'price', 'active'));

        if ($request->has('images')) {
            $product->images()->delete();
            foreach ($request->images as $path) {
                $product->images()->create(['path' => $path]);
            }
        }

        if ($request->has('discount')) {
            if ($product->discount) {
                $product->discount->update($request->discount);
            } else {
                $product->discount()->create($request->discount);
            }
        }

        return response()->json(['message' => 'Product updated successfully'], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
