<?php

namespace App\Models;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'parentId',
        'userId',
        'createdAt',
        'status',
        'priority'
    ];

    protected $casts = [
        'status' => TaskStatusEnum::class,
        'priority' => TaskPriorityEnum::class,
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getParentId(): int|null
    {
        return $this->parentId;
    }

    public function getUser(): User
    {
        return $this->belongsTo(User::class, 'userId')->first();
    }

    public function getSubTasks(): Collection
    {
        return $this->hasMany(Task::class, 'parentId')->getResults();
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

    public function getCreatedAt(): Carbon
    {
        return new Carbon($this->createdAt);
    }

    public function getCompletedAt(): ?Carbon
    {
        return new Carbon($this->completedAt);
    }
}
