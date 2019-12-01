<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'name' => 'momo_email',
                'value' => json_encode(['email'=>'abcxyz@gmail.com','password'=>'ahsjhdjasjkd'])
            ]
        ]);
    }
}
