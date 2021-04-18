<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UsersTableSeeder extends Seeder
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
            'isActive' => 1,
            'password' => Hash::make('P@ssw0rd') ,         
        ]);

        User::create([
            'name' =>   'Arnau Ribas',
            'email' => 'arnauribas@gmail.com'  ,
            'role' => 'user',
            'isActive' => 1,
            'password' => Hash::make('P@ssw0rd') ,         
        ]);

        User::create([
            'name' =>   'Alias abduscan',
            'email' => 'aliasabduscan@gmail.com'  ,
            'role' => 'user',
            'isActive' => 1,
            'password' => Hash::make('P@ssw0rd') ,         
        ]);

        User::create([
            'name' =>   'Alisa Melano',
            'email' => 'alisamelano@gmail.com'  ,
            'role' => 'user',
            'isActive' => 1,
            'password' => Hash::make('P@ssw0rd') ,         
        ]);
    }
}
