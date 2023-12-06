<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(schema="TaskResource",
 *   @OA\Property(property="id", type="integer"),
 *   @OA\Property(property="title",type="string"),
 *   @OA\Property(property="description", type="string"),
 *   @OA\Property(property="parentId", type="integer"),
 *   @OA\Property(property="priority", ref="#/components/schemas/TaskPriorityEnum"),
 *   @OA\Property(property="status", ref="#/components/schemas/TaskStatusEnum"),
 *   @OA\Property(property="createdAt", type="integer"),
 *   @OA\Property(property="completedAt", type="integer"),
 *   @OA\Property(property="user", ref="#/components/schemas/UserResource"),
 * )
 */
class TaskResource extends JsonResource
{

    public function toArray($request): array
    {
        /** @var Task $resource */
        $resource = $this->resource;
        return [
            'id' => $resource->getId(),
            'title' => $resource->getTitle(),
            'description' => $resource->getDescription(),
            'parentId' => $resource->getParentId(),
            'priority' => $resource->getPriority(),
            'status' => $resource->getStatus(),
            'createdAt' => $resource->getCreatedAt()->timestamp,
            'completedAt' => $resource->getCompletedAt()->timestamp,
            'user' => new UserResource($resource->getUser()),
        ];
    }
}
