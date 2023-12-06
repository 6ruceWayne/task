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
        for ($i = 0; $i < self::BASE_AMOUNT; $i++) {
            DB::table('users')
                ->insert([
                             'name' => Str::random(rand(0, 20)),
                             'email' => Str::random(rand(0, 10)) . '@' . Str::random(rand(0, 10)) . '.com',
                             'password' => Hash::make(Str::random(rand(0, 20))),
                         ]);
        }
    }
}
