<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Contact::factory(200)->create();

        $this->call([
        	//ContactTableSeeder::class,
            ContactTableSeeder::class,
        	UsersTableSeeder::class,

         ]);    }
}
