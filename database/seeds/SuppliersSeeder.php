<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            'name' => 'M Rahim',
            'email' => 'test@gmail.com',
            'mobile_no' => '012345678',
            'address' => 'Dhaka',
            'status' => 'active',
        ]);
    }
}
