<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductConfigurableRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'short_description' => 'required',
            'image_link' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'regular_price' => "bail|numeric|required|max:100000000",
            'discount_price' => "numeric|max:100000000",
            'qty_purchased' => 'required|numeric',
            'product_list' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Chưa nhập :attribute',
            'image_link.required' => "Chưa nhập hình ảnh",
            'image_link.regex' => 'Hình ảnh phải là url',
            'title.required' => "Chưa nhập tiêu đề",
            'short_description.required' => "Chưa nhập giới thiệu nhanh",
            'regular_price.numeric' => "Giá thông thường phải là 1 số",
            'discount_price.numeric' => "Giá đã giảm phải là 1 số",
            'product_list.required' => "Chưa nhập danh sách sản phẩm thường"
        ];
    }
}
