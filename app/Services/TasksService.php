<?php

namespace App\Services;

use App\DTO\Tasks\TaskGetBySearchFilterDTO;
use App\DTO\Tasks\TaskStoreDTO;
use App\DTO\Tasks\TaskUpdateDTO;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Repositories\TasksRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TasksService
{

    public function __construct(private TasksRepository $tasksRepository)
    {
    }

    public function store(TaskStoreDTO $taskStoreDTO): Task
    {
        return $this->tasksRepository->store($taskStoreDTO);
    }

    public function update(TaskUpdateDTO $taskUpdateDTO): Task
    {
        $task = $this->tasksRepository->getById($taskUpdateDTO->getId());
        if ($task->getStatus() === TaskStatusEnum::ToDo && $taskUpdateDTO->getStatus() === TaskStatusEnum::Done) {
            $this->tasksRepository->update($taskUpdateDTO);
            return $this->tasksRepository->setClosedAtTime($taskUpdateDTO->getId());
        }
        return $this->tasksRepository->update($taskUpdateDTO);
    }

    public function getById(int $id): Task
    {
        return $this->tasksRepository->getById($id);
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->tasksRepository->getPaginated();
    }

    public function getPaginatedBySearchFilter(TaskGetBySearchFilterDTO $taskGetBySearchFilterDTO): LengthAwarePaginator
    {
        return $this->tasksRepository->getPaginatedBySearchFilter($taskGetBySearchFilterDTO);
    }

    public function destroy(int $id): void
    {
        $this->destroyRecursively($this->tasksRepository->getById($id));
        $this->tasksRepository->destroy($id);
    }

    private function destroyRecursively(Task $task): void
    {
        $subTasks = $task->getSubTasks();
        if ($subTasks->count() === 0) {
            $this->tasksRepository->destroy($task->getId());
        }
        /** @var Task $subTask */
        foreach ($subTasks as $subTask) {
            $this->destroyRecursively($subTask);
        }
    }

}
