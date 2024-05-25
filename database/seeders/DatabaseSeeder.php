<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
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
        \App\Models\User::factory(9)->create();

        \App\Models\User::factory()->create([
            'name' => 'Christian',
            'email' => 'christian@example.com',
        ]);

        $this->call(
            [
                ProductSeeder::class,
                OrderSeeder::class
            ]
        );
    }
}
