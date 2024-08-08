<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'slug' => 'required|string|unique:products,slug',
            'price' => 'required|integer',
            'active' => 'boolean',
            'images' => 'array',
            'images.*' => 'string',
            'discount' => 'array',
            'discount.type' => 'required_with:discount|in:percent,amount',
            'discount.amount' => 'required_with:discount|integer',
        ];
    }
}
