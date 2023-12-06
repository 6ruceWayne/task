<x-guest-layout>
    <ol class="list-group list-group-numbered border-dark border-5">
        <li class="list-group-item border-dark">
            @include('task.card',['task' => $task])
            @if($task->getSubTasks()->count() > 0)
                @include('task.tasks-list-widget',['tasks' => $task->getSubTasks()])
            @endif
        </li>
    </ol>
</x-guest-layout>
