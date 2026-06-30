<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['id' => 1, 'name' => 'Alex', 'email' => 'alex@email.com', 'm_phone' => '+8111333', 'password' => '1111111'],
            ['id' => 2, 'name' => 'Test', 'email' => 'test@email.com', 'm_phone' => '+2111333', 'password' => '1111111'],
        ]);
    }
}
