<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        Food::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'category' => 'Main Course',
        ]);

        Food::create([
            'name' => 'Mie Goreng',
            'price' => 18000,
            'category' => 'Main Course',
        ]);

        Food::create([
            'name' => 'Ayam Bakar',
            'price' => 25000,
            'category' => 'Main Course',
        ]);

        Food::create([
            'name' => 'Sate Ayam',
            'price' => 23000,
            'category' => 'Main Course',
        ]);

        Food::create([
            'name' => 'Nasi Uduk',
            'price' => 17000,
            'category' => 'Main Course',
        ]);

        Food::create([
            'name' => 'Es Teh',
            'price' => 5000,
            'category' => 'Drink',
        ]);

        Food::create([
            'name' => 'Jus Alpukat',
            'price' => 15000,
            'category' => 'Drink',
        ]);

        Food::create([
            'name' => 'Es Jeruk',
            'price' => 8000,
            'category' => 'Drink',
        ]);

        Food::create([
            'name' => 'Kopi Hitam',
            'price' => 10000,
            'category' => 'Drink',
        ]);

        Food::create([
            'name' => 'Pisang Goreng',
            'price' => 12000,
            'category' => 'Snack',
        ]);
    }
}
