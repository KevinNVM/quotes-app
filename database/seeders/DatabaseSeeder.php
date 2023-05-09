<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Kevin Darmawan',
            'email' => 'kevindarmawan022@gmail.com',
            'password' => bcrypt('password')
        ]);

        \App\Models\Quote::create([
            'text' => 'Lorem Ipsum Dolor Sit Amet is a Placeholder text that were used for graphic design.',
            'user_id' => 1
        ]);
    }
}
