<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Store::factory(5)->create();
        // Category::factory(10)->create();
        // Product::factory(50)->create();
        Admin::factory(5)->create();
        // php artisan db:seed


        // call user seeder
        $this->call([
            //UserSeeder::class,
            //PostSeeder::class,
        ]);
    }
}
