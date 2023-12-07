<?php

namespace App\Repositories;

use App\DTO\Tasks\TaskGetBySearchFilterDTO;
use App\DTO\Tasks\TaskStoreDTO;
use App\DTO\Tasks\TaskUpdateDTO;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class TasksRepository
{
    private const PAGINATION_AMOUNT = 10;

    public function existByIdByUserId(int $id, int $userId): bool
    {
        return Task::where('id', '=', $id)->where('userId', '=', $userId)->exists();
    }

    public function getById(int $id): Task
    {
        return Task::find($id);
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return Task::where('parentId', '=', null)->paginate(self::PAGINATION_AMOUNT);
    }

    public function getPaginatedBySearchFilter(TaskGetBySearchFilterDTO $taskGetBySearchFilterDTO): LengthAwarePaginator
    {
        return $this->getBuilderBySearchFilter($taskGetBySearchFilterDTO)
            ->paginate(self::PAGINATION_AMOUNT);
    }

    public function getBySearchFilter(TaskGetBySearchFilterDTO $taskGetBySearchFilterDTO): Collection
    {
        return $this->getBuilderBySearchFilter($taskGetBySearchFilterDTO)->get();
    }

    public function store(TaskStoreDTO $taskCreateDTO): Task
    {
        return Task::create(
            [
                'status' => TaskStatusEnum::ToDo,
                'priority' => $taskCreateDTO->getTaskPriorityEnum(),
                'title' => $taskCreateDTO->getTitle(),
                'description' => $taskCreateDTO->getDescription(),
                'userId' => $taskCreateDTO->getUserId(),
                'parentId' => $taskCreateDTO->getParentId(),
                'createdAt' => new Carbon()
            ]
        );
    }

    public function update(TaskUpdateDTO $taskUpdateDTO): Task
    {
        Task::where('id', '=', $taskUpdateDTO->getId())
            ->update(
                [
                    'status' => $taskUpdateDTO->getStatus(),
                    'priority' => $taskUpdateDTO->getPriority(),
                    'title' => $taskUpdateDTO->getTitle(),
                    'description' => $taskUpdateDTO->getDescription(),
                ]
            );
        return $this->getById($taskUpdateDTO->getId());
    }

    public function setClosedAtTime(int $id): Task
    {
        return Task::where('id', '=', $id)
            ->update(
                [
                    'completedAt' => new Carbon(),
                ]
            );
    }

    public function destroy(int $id): void
    {
        Task::destroy($id);
    }

    private function getBuilderBySearchFilter(TaskGetBySearchFilterDTO $taskGetBySearchFilterDTO): Builder
    {
        return Task::where('parentId', '=', null)
            ->where('userId', '=', Auth::id())
            ->when(
                is_null($taskGetBySearchFilterDTO->getByText()) === false,
                function ($query) use ($taskGetBySearchFilterDTO) {
                    return $query->where('title', 'like', '%' . $taskGetBySearchFilterDTO->getByText() . '%')
                        ->orWhere('description', 'like', '%' . $taskGetBySearchFilterDTO->getByText() . '%');
                }
            )
            ->when(
                is_null($taskGetBySearchFilterDTO->getByStatus()) === false,
                function ($query) use ($taskGetBySearchFilterDTO) {
                    return $query->where('status', '=', $taskGetBySearchFilterDTO->getByStatus());
                }
            )
            ->when(
                is_null($taskGetBySearchFilterDTO->getByPriority()) === false,
                function ($query) use ($taskGetBySearchFilterDTO) {
                    return $query->where('priority', '=', $taskGetBySearchFilterDTO->getByPriority());
                }
            )
            ->when(
                is_null($taskGetBySearchFilterDTO->getSortByStatus()) === false,
                function ($query) use ($taskGetBySearchFilterDTO) {
                    return $query->orderBy('status', $taskGetBySearchFilterDTO->getSortByStatus() ? 'ASC' : 'DESC');
                }
            )
            ->when(
                is_null($taskGetBySearchFilterDTO->getSortByPriority()) === false,
                function ($query) use ($taskGetBySearchFilterDTO) {
                    return $query->orderBy('priority', $taskGetBySearchFilterDTO->getSortByPriority() ? 'ASC' : 'DESC');
                }
            )
            ->when(
                is_null($taskGetBySearchFilterDTO->getSortByCreatedAt()) === false,
                function ($query) use ($taskGetBySearchFilterDTO) {
                    return $query->orderBy(
                        'createdAt',
                        $taskGetBySearchFilterDTO->getSortByCreatedAt() ? 'ASC' : 'DESC'
                    );
                }
            )
            ->when(
                is_null($taskGetBySearchFilterDTO->getSortByCompletedAt()) === false,
                function ($query) use ($taskGetBySearchFilterDTO) {
                    return $query->orderBy(
                        'completedAt',
                        $taskGetBySearchFilterDTO->getSortByCompletedAt() ? 'ASC' : 'DESC'
                    );
                }
            );
    }
}
