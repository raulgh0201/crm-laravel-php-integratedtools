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
            'email' => 'raulgarcia@integratedtools.com'  ,
            'role' => 'admin',
            'isActive' => 1,
            'password' => Hash::make('P@ssw0rd') ,         
        ]);

        User::create([
            'name' =>   'Rol marqueting',
            'email' => 'rolmarqueting@integratedtools.com'  ,
            'role' => 'marketing',
            'isActive' => 1,
            'password' => Hash::make('P@ssw0rd') ,         
        ]);

        User::create([
            'name' =>   'Rol sales',
            'email' => 'rolsales@integratedtools.com'  ,
            'role' => 'sales',
            'isActive' => 1,
            'password' => Hash::make('P@ssw0rd') ,         
        ]);
    }
}
