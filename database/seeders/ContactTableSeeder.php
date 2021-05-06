<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Contact::factory()
            ->times(50)
            ->create();
    }
}
