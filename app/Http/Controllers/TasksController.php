<?php

namespace App\Http\Controllers;

use App\DTO\Tasks\TaskGetBySearchFilterDTO;
use App\DTO\Tasks\TaskStoreDTO;
use App\DTO\Tasks\TaskUpdateDTO;
use App\Http\Requests\TaskGetBySearchFilterRequest;
use App\Http\Requests\Tasks\TaskDestroyRequest;
use App\Http\Requests\Tasks\TaskStoreRequest;
use App\Http\Requests\Tasks\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Services\TasksService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Info(title="TestTask API", version="0.1")
 */
class TasksController extends Controller
{
    public function __construct(private TasksService $tasksService)
    {
    }

    public function index(TaskGetBySearchFilterRequest $taskGetBySearchFilterRequest): View
    {
        $user = Auth::user();
        if ($user === null) {
            return view('welcome');
        }
        $dto = new TaskGetBySearchFilterDTO($taskGetBySearchFilterRequest->validated());
        return view('welcome')->with(['tasks' => $this->tasksService->getPaginatedBySearchFilter($dto)]);
    }


    /**
     * @OA\GET(
     *     path="/tasks/getBySearchFilter",
     *     summary="Get tasks by search by text, status and priority. Also sort by status, priority, createdAt and completedAt",
     *     @OA\Response(response=200, description="Successful operation",
     *     @OA\JsonContent(
     *       @OA\Property (property="data", type="array",
     *          @OA\Items( type="array", @OA\Items(ref="#/components/schemas/TaskResource"))
     *       )
     *       )
     *      ),
     *    )
     * )
     */
    public function getBySearchFilter(TaskGetBySearchFilterRequest $taskGetBySearchFilterRequest): JsonResponse
    {
        $dto = new TaskGetBySearchFilterDTO($taskGetBySearchFilterRequest->validated());
        return $this->getSuccessResponse(
            TaskResource::collection($this->tasksService->getBySearchFilter($dto))
        );
    }


    public function create(int $parentId = null): View
    {
        return view('task/create')->with(['parentId' => $parentId]);
    }

    /**
     * @OA\POST(
     *     path="/tasks/",
     *     summary="Store new task",
     *     @OA\Parameter(name="title", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Parameter(name="description", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Parameter(name="status", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Parameter(name="priority", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=201, description="Successful operation",
     *      @OA\JsonContent(
     *       @OA\Property (property="data", type="object", ref="#/components/schemas/TaskResource")
     *       )
     *      ),
     *     )
     * )
     */
    public function store(TaskStoreRequest $taskStoreRequest): JsonResponse
    {
        $dto = new TaskStoreDTO($taskStoreRequest);
        return $this->getStoreResponse(new TaskResource($this->tasksService->store($dto)));
    }

    public function show(int $id): View
    {
        return view('task/show')->with(['task' => $this->tasksService->getById($id)]);
    }

    public function edit(int $id): View
    {
        return view('task/edit')->with(['task' => $this->tasksService->getById($id)]);
    }

    /**
     * @OA\PUT(path="/tasks/",
     *     summary="Update Task. Changing status from Done to ToDo is not allowed due to not allowing deleting Done tasks",
     *     @OA\Parameter(name="id", in="query", required=true, @OA\Schema(type="integer")),
     *     @OA\Parameter(name="title", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Parameter(name="description", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Parameter(name="status", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Parameter(name="priority", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=201, description="Successful operation",
     *      @OA\JsonContent(
     *       @OA\Property (property="data", type="object", ref="#/components/schemas/TaskResource")
     *       )
     *      ),
     *     )
     * )
     */
    public function update(TaskUpdateRequest $taskUpdateRequest): JsonResponse
    {
        $dto = new TaskUpdateDTO($taskUpdateRequest->validated());
        $task = $this->tasksService->update($dto);
        return $this->getStoreResponse(new TaskResource($task));
    }

    /**
     * @OA\DELETE(
     *     path="/tasks/",
     *     summary="Deleting task. Only toDo task that do not have Done subTasks",
     *     @OA\Parameter(name="id", in="query", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="204", description="No content response"),
     * )
     */
    public function destroy(TaskDestroyRequest $taskDestroyRequest): Response
    {
        $this->tasksService->destroy($taskDestroyRequest->get('id'));
        return $this->getNoContentResponse();
    }
}
