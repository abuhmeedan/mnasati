<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Waleed Admin',
            'email' => 'admin@abuhmeedan.com',
            'password' => Hash::make('Ww1234567'),
            'is_admin' => true,
        ]);
        User::create([
            'name' => 'Waleed User',
            'email' => 'waleed@abuhmeedan.com',
            'password' => Hash::make('Ww1234567'),
            'is_admin' => false,
        ]);
    }
}
