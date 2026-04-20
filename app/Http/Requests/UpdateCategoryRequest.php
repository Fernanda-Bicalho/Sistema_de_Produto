<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'category_description' => 'sometimes|required|string|min:3|max:255',
            'status' => 'nullable|boolean',
            'price'  => 'snullable|numeric|numeric|min:0',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'category_description.required' => 'The description cannot be empty when updating.',
            'status.boolean' => 'The status must be a valid value (Active/Inactive).',
            'price.required' => 'The price is required.',
            'price.numeric'  => 'The price must be a valid number.',
            'price.min'      => 'The price cannot be negative.',
        ];
    }
}
