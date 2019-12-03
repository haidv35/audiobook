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
     * @return array
     */
    public function rules()
    {

        return [
            // 'image_upload' => ($this->route('admin.product.create')) ? 'bail|required|image|mimes:jpeg,png,jpg,gif|max:5012' : 'bail|image|mimes:jpeg,png,jpg,gif|max:5012',
            'image_link' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'category_id' => 'required',
            'title' => 'required',
            'short_description' =>  'required',
            'description' =>  'required',
            'regular_price' => "bail|numeric|required|max:100000000",
            'discount_price' => "numeric|max:100000000",
            'product_links' => "required|array",
            'product_links.*' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'demo_link' => ['nullable','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'new_product' => "max:1",
            'hot_product' => "max:1",
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Chưa nhập :attribute',
            'category_id.required' => 'Chưa có category',
            'image_link.required' => "Chưa nhập hình ảnh",
            'image_link.regex' => 'Hình ảnh phải là url',
            'title.required' => "Chưa nhập tiêu đề",
            'short_description.required' => "Chưa nhập giới thiệu nhanh",
            'demo_link.regex' => "Demo phải là url",
            'product_links.*.regex' => "Sản phẩm phải là url",
            'image_upload.required' => "Chưa nhập ảnh",
            'image_upload.size' => "Ảnh tối đa 2MB",
            'description.required' => "Chưa nhập nội dung mô tả",
            'regular_price.numeric' => "Giá thông thường phải là 1 số",
            'discount_price.numeric' => "Giá đã giảm phải là 1 số",
        ];
    }
}
