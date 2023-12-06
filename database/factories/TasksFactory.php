<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TasksFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => Str::random(rand(3, 30)),
            'description' => Str::random(rand(3, 255)),
            'userId' => rand(1, 10),
            'parentId' => rand(0, 5),
            'createdAt' => (new Carbon())
                ->subDays(random_int(1, 5))
                ->subMinutes(random_int(1, 500))
        ];
    }
}
