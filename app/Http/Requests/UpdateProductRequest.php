<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|min:2|max:150',
            'product_description' => 'sometimes|required|string|min:3|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'description.required' => 'The product description is required.',
            'price.required' => 'The price field is required.',
            'price.numeric'  => 'The price must be a valid number.',
            'category_id.exists'   => 'The selected category is invalid.',
            'category_id.required' => 'The product must belong to a category.',
        ];
    }
}
