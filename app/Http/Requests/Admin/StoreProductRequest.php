<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand' => ['required','numeric'],
            'category' => ['required','numeric'],
            'product_name' => ['required','unique:products,name'],
            'price' => ['required','numeric'],
            'product_image' => ['required','image'],
            'small_stock' => ['required','numeric'],
            'medium_stock' => ['required','numeric'],
            'large_stock' => ['required','numeric'],
            'extra_large_stock' => ['required','numeric'],
            'description' => ['required']
        ];
    }
}
