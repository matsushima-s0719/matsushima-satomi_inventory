<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  
    public function run(): void
    {
        User::create([
            'name' => '山田 太郎',
            'email' => 'yamada@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => '佐藤 花子',
            'email' => 'sato@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}