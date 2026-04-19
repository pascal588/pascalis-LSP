<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default Admin
        User::factory()->create([
            'name' => 'Admin POS',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Default Kasir
        User::factory()->create([
            'name' => 'Kasir Toko',
            'email' => 'kasir@example.com',
            'password' => bcrypt('password'),
            'role' => 'kasir',
        ]);

        // Sample Categories
        $food = \App\Models\Category::create(['name' => 'Makanan']);
        $drink = \App\Models\Category::create(['name' => 'Minuman']);
        $snack = \App\Models\Category::create(['name' => 'Snack']);

        // Sample Items
        \App\Models\Item::create([
            'category_id' => $food->id,
            'name' => 'Nasi Goreng Spesial',
            'price' => 25000,
            'stock' => 50
        ]);

        \App\Models\Item::create([
            'category_id' => $food->id,
            'name' => 'Mie Ayam Bakso',
            'price' => 18000,
            'stock' => 30
        ]);

        \App\Models\Item::create([
            'category_id' => $drink->id,
            'name' => 'Es Teh Manis',
            'price' => 5000,
            'stock' => 100
        ]);

        \App\Models\Item::create([
            'category_id' => $drink->id,
            'name' => 'Kopi Susu Gula Aren',
            'price' => 15000,
            'stock' => 40
        ]);

        \App\Models\Item::create([
            'category_id' => $snack->id,
            'name' => 'Keripik Singkong Pedas',
            'price' => 10000,
            'stock' => 25
        ]);
    }
}
