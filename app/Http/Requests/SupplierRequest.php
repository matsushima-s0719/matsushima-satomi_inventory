<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:100'],
            'phone'   => ['nullable', 'string', 'max:20', 'regex:/^[0-9\-]+$/'],
            'email'   => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '仕入先名は必須です。',
            'name.max'      => '仕入先名は100文字以内で入力してください。',
            'phone.max'     => '電話番号は20文字以内で入力してください。',
            'phone.regex'   => '電話番号は半角数字とハイフン（-）で入力してください。',
            'email.email'   => '有効なメールアドレス形式で入力してください。',
            'email.max'     => 'メールアドレスは255文字以内で入力してください。',
            'address.max'   => '住所は255文字以内で入力してください。',
        ];
    }
}