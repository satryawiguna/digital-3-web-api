<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Insert user table records
        DB::table('users')->insert([
            [ 'email' => 'admin@digital3.com', 'password' => \Hash::make('d3f4ult'), 'status' => '1']
        ]);
    }
}
