<?php

namespace App\Imports;

use App\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

use Illuminate\Support\Facades\Validator;

class CategoryImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collection)
    {
        Validator::make($collection->toArray(), [
            '*.name'=>'required|string',
            '*.parent_id'=>'nullable|string',
        ],[
            'required' => 'Chưa nhập :attribute',
            'numeric' => 'parent_id phải là 1 số',
            'string' => 'name phải là văn bản',
        ])->validate();
        foreach ($collection as $row) {
            Category::updateOrCreate([
                'name'=>$row['name'],
                'parent_id'=>$row['parent_id'],
            ]);
        }
    }
}
