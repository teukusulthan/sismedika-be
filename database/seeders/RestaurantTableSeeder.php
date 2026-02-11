<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RestaurantTable;

class RestaurantTableSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 10) as $number) {
            RestaurantTable::create([
                'number' => $number,
                'status' => 'available',
            ]);
        }
    }
}
