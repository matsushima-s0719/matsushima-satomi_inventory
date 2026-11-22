<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
      
        $categoryId = $this->route('category')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('categories', 'name')->ignore($categoryId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'カテゴリ名は必須です。',
            'name.max'      => 'カテゴリ名は50文字以内で入力してください。',
            'name.unique'   => 'このカテゴリ名はすでに登録されています。',
        ];
    }
}