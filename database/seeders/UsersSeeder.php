<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    private const BASE_AMOUNT = 10;

    public function run(): void
    {
        DB::table('users')
            ->insert([
                'name' => 'Vasya',
                'email' => 'test@test.com',
                'password' => Hash::make('123456789'),
            ]);
    }
}
