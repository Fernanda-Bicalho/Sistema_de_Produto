<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'required|string|min:2|max:150',
            'product_description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.min'      => 'The name must be at least 2 characters.',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a valid number.',
            'category_id.required' => 'You must select a valid category.',
            'category_id.exists'   => 'The selected category does not exist.',
        ];
    }
}
