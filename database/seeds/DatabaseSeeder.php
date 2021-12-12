<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        Model::unguard();

        ini_set('memory_limit','512M');

        //Delete table records
        DB::table('user_roles')->delete();
        DB::table('roles')->delete();
        DB::table('users')->delete();

        //Call seeder
        $this->call('RoleSeeder');
        $this->call('UserSeeder');
        $this->call('UserRoleSeeder');
    }
}
