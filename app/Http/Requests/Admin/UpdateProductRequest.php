<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    private $id;

    public function __construct()
    {
        $this->id = $this->route('id');
    }
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
            'product_name' => ['required', Rule::unique('products','name')->ignore($this->route('product'))],
            'price' => ['numeric'],
            'product_image' => ['image'],
            'S' => ['required','numeric'],
            'M' => ['required','numeric'],
            'L' => ['required','numeric'],
            'XL' => ['required','numeric'],
            'description' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'S.required' => 'Small Stock field is required',
            'M.required' => 'Medium Stock field is required',
            'L.required' => 'Large Stock field is required',
            'XL.required' => 'Extra Large Stock field is required',
        ];
    }
}
