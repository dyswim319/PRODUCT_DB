<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required | max:255',
            'img_path' => 'required | max:255',
            'product_name' => 'required | max:255',
            'price' => 'required | max:255',
            'stock' => 'required | max:255',
            'company_id' => 'required | max:255',
            'comment' => 'max:10000',
        ];
    }

    /**
     * 項目名
     *
     * @return array
     */
    public function attributes() {
        return [
            'id' => 'ID',
            'img_path' => '商品画像',
            'product_name' => '商品名',
            'price' => '価格',
            'stock' => '在庫数',
            'company' => 'メーカー名',
            'comment' => 'コメント',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'id.required' => ':attributeは必須項目です。',
            'id.max' => ':attributeは:max字以内で入力してください。',
            'img_path.required' => ':attributeは必須項目です。',
            'img_path.max' => ':attributeは:max字以内で入力してください。',
            'product_name.required' => ':attributeは必須項目です。',
            'product_name.max' => ':attributeは:max字以内で入力してください。',
            'price.required' => ':attributeは必須項目です。',
            'price.max' => ':attributeは:max字以内で入力してください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.max' => ':attributeは:max字以内で入力してください。',
            'company.required' => ':attributeは必須項目です。',
            'company.max' => ':attributeは:max字以内で入力してください。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
        ];
    }
}