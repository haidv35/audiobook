<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =  array(
            array('id' => 1, 'name' => 'store', 'lft' => 1, 'rgt' => 20, 'parent_id' => null),
                array('id' => 2, 'name' => 'notebooks', 'lft' => 2, 'rgt' => 7, 'parent_id' => 1),
                    array('id' => 3, 'name' => 'apple', 'lft' => 3, 'rgt' => 4, 'parent_id' => 2),
                    array('id' => 4, 'name' => 'lenovo', 'lft' => 5, 'rgt' => 6, 'parent_id' => 2),
                array('id' => 5, 'name' => 'mobile', 'lft' => 8, 'rgt' => 19, 'parent_id' => 1),
                    array('id' => 6, 'name' => 'nokia', 'lft' => 9, 'rgt' => 10, 'parent_id' => 5),
                    array('id' => 7, 'name' => 'samsung', 'lft' => 11, 'rgt' => 14, 'parent_id' => 5),
                        array('id' => 8, 'name' => 'galaxy', 'lft' => 12, 'rgt' => 13, 'parent_id' => 7),
                    array('id' => 9, 'name' => 'sony', 'lft' => 15, 'rgt' => 16, 'parent_id' => 5),
                    array('id' => 10, 'name' => 'lenovo', 'lft' => 17, 'rgt' => 18, 'parent_id' => 5),
            array('id' => 11, 'name' => 'store_2', 'lft' => 21, 'rgt' => 22, 'parent_id' => null),
        );
        \DB::table('categories')->insert($data);
    }
}
