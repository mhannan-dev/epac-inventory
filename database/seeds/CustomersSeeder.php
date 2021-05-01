<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('customers')->insert([
            'name' => 'M Hannan',
            'email' => 'test@gmail.com',
            'mobile_no' => '012345678',
            'address' => 'Dhaka',

        ]);
    }
}
