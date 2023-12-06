<?php

namespace App\Enums;
/**
 * @OA\Schema(
 *   schema="TaskPriorityEnum",
 *   @OA\Property(property="key",type="string"),
 *   @OA\Property(property="value",type="integer"),
 * )
 */
enum TaskPriorityEnum: int
{
    case One = 1;
    case Two = 2;
    case Three = 3;
    case Four = 4;
    case Five = 5;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getRandom(): self
    {
        return self::cases()[rand(0, count(self::cases()) - 1)];
    }
}
