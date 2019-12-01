<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductIERequest extends FormRequest
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
            'import_file' => 'mimes:xlsx,xls',
        ];
    }
    public function messages()
    {
        return [
            'import_file.mimes' => 'Sai định dạng file. Phải là file excel có đuôi là xlsx hoặc xls',
        ];
    }
}
