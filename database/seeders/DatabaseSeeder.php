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
        \App\Models\User::factory()->create(['email' => 'adams@adams.cl', 'password' => bcrypt('12345678')]);
        \App\Models\User::factory(9)->create();
        
        \App\Models\Category::factory(10)
        ->hasThreads(20)
        ->create();

        \App\Models\User::factory(400)->create();
        
    }
}
