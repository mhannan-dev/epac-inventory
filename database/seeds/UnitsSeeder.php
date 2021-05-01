<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('units')->insert([
            'name' => 'KG',
            'status' => 'active',
        ]);
    }
}
