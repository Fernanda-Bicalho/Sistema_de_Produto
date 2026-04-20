<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [

            'category_description' => 'required|string|min:3|max:255',
        ];
    }


    public function messages(): array
    {
        return [
            'category_description.required' => 'A descrição da categoria é obrigatória.',
            'category_description.min'      => 'A descrição deve ter pelo menos 3 caracteres.',
            'category_description.max'      => 'A descrição não pode ultrapassar 255 caracteres.',
        ];
    }
}