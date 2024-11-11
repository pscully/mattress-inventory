<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'patrick',
            'email' => 'alyssa@test.com',
            'password' => bcrypt('asdf6900'),
        ]);

        $stores = ['Indian Trail', 'Monroe Rd.', 'South Blvd.', 'Gastonia'];

        foreach($stores as $store) {
            Store::create([
                "name" => $store
            ]);

        }


    }
}
