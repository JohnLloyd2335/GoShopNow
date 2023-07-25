<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['required','string', Rule::unique('categories')->ignore($this->route('product_category'))]
        ];
    }

    public function messages(){
        return [
            'name.unique' => 'The category is already created , please enter other category name'
        ];
    }
}
