<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function show(Request $request, $slug)
    {
        $entity = $this->service->show($slug);

        if (!$entity) {
            return response()->json([
                'data' => null,
                'msg' => 'Item not found.'
            ], Response::HTTP_NOT_FOUND);
        }
        
        return new ProductResource($entity);
    }
}
