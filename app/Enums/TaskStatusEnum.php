<?php

namespace App\Enums;

/**
 * @OA\Schema(
 *   schema="TaskStatusEnum",
 *   @OA\Property(property="key",type="string"),
 *   @OA\Property(property="value",type="string"),
 * )
 */
enum TaskStatusEnum: string
{
    case ToDo = 'toDo';
    case Done = 'done';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getRandom(): self
    {
        return self::cases()[rand(0, count(self::cases()) - 1)];
    }

}
