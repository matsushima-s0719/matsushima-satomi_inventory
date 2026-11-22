<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $itemId = $this->route('item')?->id;

        $rules = [
            'name'          => ['required', 'string', 'max:100'],
            'jan_code'      => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9]+$/',
                Rule::unique('items', 'jan_code')->ignore($itemId),
            ],
            'category_id'   => ['required', 'exists:categories,id'],
            'supplier_id'   => ['required', 'exists:suppliers,id'],
            'unit_price'    => ['required', 'integer', 'min:0'],
            'reorder_point' => ['required', 'integer', 'min:0'],
            'description'   => ['nullable', 'string', 'max:1000'],
        ];

        if ($this->isMethod('post')) {
            $rules['stock_quantity'] = ['required', 'integer', 'min:0'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required'           => '商品名は必須です。',
            'name.max'                => '商品名は100文字以内で入力してください。',
            'jan_code.max'            => 'JANコードは20文字以内で入力してください。',
            'jan_code.regex'          => 'JANコードは半角数字のみで入力してください。',
            'jan_code.unique'         => 'このJANコードはすでに登録されています。',
            'category_id.required'    => 'カテゴリを選択してください。',
            'category_id.exists'      => '選択されたカテゴリが正しくありません。',
            'supplier_id.required'    => '仕入先を選択してください。',
            'supplier_id.exists'      => '選択された仕入先が正しくありません。',
            'stock_quantity.required' => '初期在庫数は必須です。',
            'stock_quantity.integer'  => '初期在庫数は整数で入力してください。',
            'stock_quantity.min'      => '初期在庫数は0以上で入力してください。',
            'unit_price.required'     => '単価は必須です。',
            'unit_price.integer'      => '単価は整数で入力してください。',
            'unit_price.min'          => '単価は0以上で入力してください。',
            'reorder_point.required'  => '発注点は必須です。',
            'reorder_point.integer'   => '発注点は整数で入力してください。',
            'reorder_point.min'       => '発注点は0以上で入力してください。',
            'description.max'         => '商品説明は1000文字以内で入力してください。',
        ];
    }
}