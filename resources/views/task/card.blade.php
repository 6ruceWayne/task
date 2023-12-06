@php
    use \App\Models\Task;
    use \Carbon\Carbon;
    /** @var Task $task */
@endphp
<span>{{'Title:'}}</span>
<span>{{$task->getTitle()}}</span>
<br>
<span>{{'Description:'}}</span>
<span>{{$task->getDescription()}}</span>
<br>
<div class="flex mb-3">
    <div class="flex-none w-1/4 mr-20">
        <span>{{'Status:'}}</span>
        <span>{{$task->getStatus()}}</span>
        <br>
        <span>{{'Priority:'}}</span>
        <span>{{$task->getPriority()}}</span>
    </div>
    <div class="flex-none w-1/2 mr-5">
        <span>{{'CreatedAt:'}}</span>
        <span>{{(new Carbon($task->getCreatedAt()))->format('Y-m-d h:m:s')}}</span>
        <br>
        <span>{{'CompletedAt:'}}</span>
        <span>{{(new Carbon($task->getCompletedAt()))->format('Y-m-d h:m:s')}}</span>
    </div>
</div>
<div class="mb-3">
    <button type="button" class="btn btn-primary"
            onclick="window.location.href='{{route('tasks.edit', $task->getId())}}'">Edit
    </button>
    <button type="button" class="btn btn-success"
            onclick="window.location.href='{{route('tasks.create', $task->getId())}}'">Add SubTask
    </button>
    <button id="delete" type="button" class="btn btn-danger delete" data-id="{{$task->getId()}}">Delete
    </button>
    <button type="button" class="btn btn-warning"
            onclick="window.location.href='{{route('tasks.show', $task->getId())}}'">Show
    </button>
</div>
