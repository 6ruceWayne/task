<?php

namespace App\DTO\Tasks;

use App\Enums\TaskPriorityEnum;
use App\Http\Requests\Tasks\TaskStoreRequest;

class TaskStoreDTO
{
    private int $userId;
    private string $title;
    private string $description;
    private int|null $parentId;
    private TaskPriorityEnum $taskPriorityEnum;

    public function __construct(TaskStoreRequest $taskStoreRequest)
    {
        $params = $taskStoreRequest->validated();
        $this->userId = $taskStoreRequest->user()->getId();
        $this->title = $params['title'];
        $this->description = $params['description'];
        $this->parentId = array_key_exists('parentId', $params) === true ? $params['parentId'] : null;
        $this->taskPriorityEnum = TaskPriorityEnum::from($params['priority']);
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function getTaskPriorityEnum(): TaskPriorityEnum
    {
        return $this->taskPriorityEnum;
    }

}
