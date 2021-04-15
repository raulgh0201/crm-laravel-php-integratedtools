<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>   'Raul Garcia',
            'email' => 'aplicacionwebm12@gmail.com'  ,
            'role' => 'admin',
            'password' => Hash::make('P@ssw0rd') ,         
        ]);
    }
}
