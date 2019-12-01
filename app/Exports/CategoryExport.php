<?php

namespace App\Exports;

use App\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements FromCollection,WithTitle,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::get(['id','name','parent_id']);
    }
    public function title(): string
    {
        return 'Category';
    }
    public function headings(): array
    {
        return [
            'id',
            'name',
            'parent_id',
        ];
    }
}
