<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Admin Name',
            //'username' => 'admin',
            'email' => 'epacinv@gmail.com',
            'password' => bcrypt('rootAdminQP'),

        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Author Name',
            //'username' => 'author',
            'email' => 'hannan@arobil.com',
            'password' => bcrypt('rootadmin'),

        ]);


    }
}
