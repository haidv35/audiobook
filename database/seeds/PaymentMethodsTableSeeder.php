<?php

use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            [
                'type' => 'bank',
                'info' => json_encode(['fullname'=>'Đinh Viết Hải','acc_num'=>'01234567890','branch'=>'Tp Bank Chiến thắng'])
            ],
            [
                'type' => 'momo',
                'info' => json_encode(['qr_str'=>'2|99|0372791909|DINH VIET HAI|cloverdoser@gmail.com|0|0'])
            ]
        ]);
    }
}
