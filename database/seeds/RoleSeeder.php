<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'super', 'description' => 'description of super role'],
            ['name' => 'admin', 'description' => 'description of admin role'],
            ['name' => 'agent', 'description' => 'description of agent role'],
            ['name' => 'member', 'description' => 'description of member role'],
            ['name' => 'guest', 'description' => 'description of guest role']
        ]);
    }
}
