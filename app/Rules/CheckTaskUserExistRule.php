<?php

namespace App\Rules;

use App\Models\User;
use App\Repositories\TasksRepository;
use Illuminate\Contracts\Validation\Rule;

class CheckTaskUserExistRule implements Rule
{
    private User $user;

    public function __construct(User $user, private TasksRepository $tasksRepository)
    {
        $this->user = $user;
    }

    public function passes($attribute, $value): bool
    {
        return $this->tasksRepository->existByIdByUserId($value, $this->user->getId());
    }

    public function message(): string
    {
        return 'The userId is not the same as current user.';
    }
}
