<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required',
            'slug' => 'sometimes|required|string|unique:products,slug,' . $this->route('product')->id,
            'price' => 'sometimes|required|integer',
            'active' => 'sometimes|boolean',
            'images' => 'array',
            'images.*' => 'string',
            'discount' => 'array',
            'discount.type' => 'required_with:discount|in:percent,amount',
            'discount.amount' => 'required_with:discount|integer',
        ];
    }
}
