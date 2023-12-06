<?php

namespace App\DTO\Tasks;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;

class TaskGetBySearchFilterDTO
{
    private string|null $byText;
    private TaskStatusEnum|null $byStatus;
    private TaskPriorityEnum|null $byPriority;
    private bool|null $sortByStatus;
    private bool|null $sortByPriority;
    private bool|null $sortByCreatedAt;
    private bool|null $sortByCompletedAt;

    public function __construct(array $params)
    {
        $this->byText = array_key_exists('byText', $params) ?
            (string)$params['byText'] : null;
        $this->byStatus = array_key_exists('byStatus', $params) ?
            TaskStatusEnum::from((string)$params['byStatus']) : null;
        $this->byPriority = array_key_exists('byPriority', $params) ?
            TaskPriorityEnum::from((int)$params['byPriority']) : null;
        $this->sortByStatus = array_key_exists('sortByStatus', $params) ?
            (bool)$params['sortByStatus'] : null;
        $this->sortByPriority = array_key_exists('sortByPriority', $params) ?
            (bool)$params['sortByPriority'] : null;
        $this->sortByCreatedAt = array_key_exists('sortByCreatedAt', $params) ?
            (bool)$params['sortByCreatedAt'] : null;
        $this->sortByCompletedAt = array_key_exists('sortByCompletedAt', $params) ?
            (bool)$params['sortByCompletedAt'] : null;
    }

    public function getByText(): ?string
    {
        return $this->byText;
    }

    public function getByStatus(): ?TaskStatusEnum
    {
        return $this->byStatus;
    }

    public function getByPriority(): ?TaskPriorityEnum
    {
        return $this->byPriority;
    }

    public function getSortByStatus(): ?bool
    {
        return $this->sortByStatus;
    }

    public function getSortByPriority(): ?bool
    {
        return $this->sortByPriority;
    }

    public function getSortByCreatedAt(): ?bool
    {
        return $this->sortByCreatedAt;
    }

    public function getSortByCompletedAt(): ?bool
    {
        return $this->sortByCompletedAt;
    }

}
