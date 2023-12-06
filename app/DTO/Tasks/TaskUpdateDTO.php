<?php

namespace App\DTO\Tasks;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;

class TaskUpdateDTO
{
    private int $id;
    private string $title;
    private string $description;
    private TaskStatusEnum $status;
    private TaskPriorityEnum $priority;

    public function __construct(array $params)
    {
        $this->id = $params['id'];
        $this->title = $params['title'];
        $this->description = $params['description'];
        $this->status = TaskStatusEnum::from($params['status']);
        $this->priority = TaskPriorityEnum::from($params['priority']);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): TaskStatusEnum
    {
        return $this->status;
    }

    public function getPriority(): TaskPriorityEnum
    {
        return $this->priority;
    }

}
