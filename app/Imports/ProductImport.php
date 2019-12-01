<?php

namespace App\Imports;

use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithValidation;
use App\Product;
use App\Category;
use App\ProductLink;
use App\Description;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

//,ToModel,WithValidation
class ProductImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    /*
    use Importable;
    public function model(array $row)
    {
        return new Product([
            'user_id' => Auth::user()->id,
            'category_id' => $row['category_id'],
            'title' => $row['title'],
            'short_description' => $row['short_description'],
            'image' => $row['image'],
            'demo_link' => $row['demo_link'],
            'regular_price' => $row['regular_price'],
            'discount_price' => $row['discount_price'],
            'new_product' => $row['new_product'],
            'hot_product' => $row['hot_product'],
            'qty_purchased' => $row['qty_purchased'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);
    }
    */

    public function collection(Collection $collection)
    {
        Validator::make($collection->toArray(), [
            '*.category_id' => 'required|numeric',
            '*.title' => 'required|string',
            '*.short_description' => 'required|string',
            '*.image' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            '*.demo_link' => ['nullable','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            '*.regular_price' => 'required|regex:/^(\d+(,\d{1,2})?)?$/',
            '*.discount_price' => 'nullable|regex:/^(\d+(,\d{1,2})?)?$/',
            '*.new_product' => 'required|digits:1',
            '*.hot_product' => 'required|digits:1',
            '*.qty_purchased' => 'required|numeric',
            '*.created_at' => 'nullable',
            '*.updated_at' => 'nullable',
            '*.description' => 'required|string',
            '*.product_link' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i']
        ],[
            'numeric' => ':attribute phải là 1 số',
            'string' => ':attribute phải là văn bản',
            'required' => ':attribute còn trống',
            '*.image.regex' => 'image sai định dạng',
            '*.demo_link.regex' => 'demo_link sai định dạng',
            '*.regular_price.regex' => 'regular_price sai định dạng',
            '*.discount_price.regex' => 'discount_price sai định dạng',
        ])->validate();

        foreach ($collection as $row)
        {
            $product = Product::updateOrCreate([
                'user_id' => Auth::user()->id,
                'category_id' => $row['category_id'],
                'title' => $row['title'],
                'short_description' => $row['short_description'],
                'image' => $row['image'],
                'demo_link' => $row['demo_link'],
                'regular_price' => $row['regular_price'],
                'discount_price' => $row['discount_price'],
                'new_product' => $row['new_product'],
                'hot_product' => $row['hot_product'],
                'qty_purchased' => $row['qty_purchased'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
            ]);


            $description = Description::updateOrCreate([
                'product_id' => $product->id,
                'content' => $row['description'],
            ]);


            // $product_link = explode("\t",$row['product_link']);
            $product_link = preg_split("/([\n|\t|\s])+/",$row['product_link']);
            array_filter($product_link, function($value) { return !is_null($value) && $value !== ''; });
            foreach ($product_link as $key => $value) {
                $check = filter_var($value, FILTER_VALIDATE_URL);
                if($check != false){
                    ProductLink::updateOrCreate([
                        'product_id'=>$product->id,
                        'content'=>$value
                    ]);
                }
            }

        }
    }

    // public function rules(): array
    // {
    //     return [
    //         'category_id' => function($attribute, $value, $onFailure) {
    //             if (!is_string($value)) {
    //                 $onFailure('Giá trị cột phải là văn bản');
    //             }
    //         }
    //     ];
    // }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
