<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    private $id;

    public function __construct(){
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->route('manage_user'))],
            'address_line_1' => ['required', 'string'],
            'address_line_2' => ['string'],
            'region' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city_municipality' => ['required', 'string'],
            'mobile_number' => ['required', 'numeric', 'digits:11'],
            'postal_code' => ['required', 'numeric'],
            'status' => ['required','numeric','in:0,1']
        ];
    }
}
