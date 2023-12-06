<?php

namespace Database\Seeders;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TasksSeeder extends Seeder
{
    private const BASE_AMOUNT = 30;

    public function run(): void
    {
        $userIds = DB::table('users')->pluck('id');
        foreach ($userIds as $userId) {
            for ($i = 0; $i < self::BASE_AMOUNT; $i++) {
                $parentId = null;
                $count = DB::table('tasks')
                    ->where('userId', '=', $userId)
                    ->count();
                if (rand(0, 10) > 4 && $count > 0) {
                    $parentId = $this->getRandomParentIdByUserId($userId);
                }
                $wordsAmount = rand(3, 20);
                $description = '';
                for ($j = 0; $j < $wordsAmount; $j++) {
                    $description .= Str::random(rand(1, 10)) . ' ';
                }

                $wordsAmount = rand(1, 4);
                $title = '';
                for ($k = 0; $k < $wordsAmount; $k++) {
                    $title .= Str::random(rand(1, 10)) . ' ';
                }
                $status = TaskStatusEnum::getRandom()->value;
                $createdAt = (new Carbon())
                    ->subDays(random_int(1, 5))
                    ->subMinutes(random_int(1, 500))
                    ->subSeconds(random_int(1, 50));
                $insert = [
                    'userId' => $userId,
                    'title' => $title,
                    'description' => $description,
                    'parentId' => $parentId,
                    'createdAt' => $createdAt,
                    'status' => $status,
                    'priority' => TaskPriorityEnum::getRandom()->value,
                ];
                if($status == TaskStatusEnum::Done){
                    $insert['completedAt'] = (new Carbon($createdAt))->addHours(random_int(1, 5))
                        ->addMinutes(random_int(1, 50))
                        ->addSeconds(random_int(1, 50));
                }
                DB::table('tasks')->insert(
                    [
                        'userId' => $userId,
                        'title' => $title,
                        'description' => $description,
                        'parentId' => $parentId,
                        'createdAt' => $createdAt,
                        'status' => $status,
                        'priority' => TaskPriorityEnum::getRandom()->value,
                    ]
                );
            }
        }
    }

    private function getRandomParentIdByUserId(int $userId): int
    {
        return (int)DB::table('tasks')
            ->where('userId', '=', $userId)
            ->inRandomOrder()
            ->first()
            ->id;
    }
}
