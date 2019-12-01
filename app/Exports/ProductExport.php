<?php

namespace App\Exports;

use App\Product;
use App\Description;
use App\ProductLink;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;



class ProductExport implements FromView,WithTitle,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('admin.product.export', [
            'products' => Product::all(),
        ]);
    }
    // public function collection()
    // {
        // foreach(Product::all() as $product){
        //     Product::get('category_id'),
        //     Product::get('title'),
        //     Product::get('short_description'),
        //     Description::get('content'),
        //     Product::get('image'),
        //     Product::get('demo_link'),
        //     Product::get('regular_price'),
        //     Product::get('discount_price'),
        //     ProductLink::get('content'),
        //     Product::get('new_product'),
        //     Product::get('hot_product'),
        //     Product::get('qty_purchased'),
        //     Product::get('created_at'),
        //     Product::get('updated_at'),
        // }
        // $product = Product::get(['category_id','title','short_description','image','demo_link','regular_price','discount_price','new_product','hot_product','qty_purchased','created_at','updated_at']);
        // $description = Description::get(['content']);
        // $product_link = ProductLink::get(['content']);
    // }
    public function title(): string
    {
        return 'Product';
    }
    public function headings(): array
    {
        return [
            'category_id',
            'title',
            'short_description',
            'description',
            'image',
            'demo_link',
            'regular_price',
            'discount_price',
            'product_link',
            'new_product',
            'hot_product',
            'qty_purchased',
            'created_at',
            'updated_at',
        ];
    }
}
