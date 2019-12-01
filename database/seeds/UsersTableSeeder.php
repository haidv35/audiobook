<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'firstname' => 'Hai',
                'lastname' => 'Clover',
                'username' => 'cl0v3r',
                // 'email_verified_at' => Carbon::now()->timestamp,
                'email' => 'cloverdoser@gmail.com',
                'password' => bcrypt('Haiclover99'),
                'phone' => '0372791909',
                'address' => 'HN',
                'role' => 'admin'
            ],
            [
                'firstname' => 'Mr',
                'lastname' => 'kezy',
                'username' => 'cl0v3r',
                // 'email_verified_at' => Carbon::now()->timestamp,
                'email' => 'taan@lat.com.vn',
                'password' => bcrypt('hoilamgi123@'),
                'phone' => '0372791909',
                'address' => 'HN',
                'role' => 'admin'
            ]
        );
    }
}
