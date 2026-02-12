<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Siska',
            'email' => 'waiter@sismedika.com',
            'password' => Hash::make('password'),
            'role' => 'waiter',
        ]);

        User::create([
            'name' => 'Ahmad',
            'email' => 'cashier@sismedika.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
        ]);
    }
}
