@php
    use \App\Models\Task;
    /** @var Task $task */
@endphp
<x-guest-layout>

    <form>
        @csrf
        <input type="hidden" id="id" value="{{$task->getId()}}">
        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <input id="title" class="block mt-1 w-full" value="{{$task->getTitle()}}" type="text" name="title" required autofocus />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea rows="7" id="description" class="block mt-1 w-full" type="text" name="description" required autofocus>{{$task->getDescription()}}</textarea>
        </div>

        <div>
            <x-input-label for="description" :value="__('Priority')" />
            <select class="form-select" name="priority" id="priority">
                <option value="1" @if($task->getPriority()->value === 1) selected="selected" @endif>One</option>
                <option value="2" @if($task->getPriority()->value === 2) selected="selected" @endif>Two</option>
                <option value="3" @if($task->getPriority()->value === 3) selected="selected" @endif>Three</option>
                <option value="4" @if($task->getPriority()->value === 4) selected="selected" @endif>Four</option>
                <option value="5" @if($task->getPriority()->value === 5) selected="selected" @endif>Five</option>
            </select>
        </div>

        <div>
            <x-input-label for="description" :value="__('Status')" />
            <select class="form-select" name="status" id="status" @if($task->getStatus()->value === "done") disabled @endif>
                <option value="toDo" @if($task->getStatus()->value === "toDo") selected="selected" @endif>ToDo</option>
                <option value="done" @if($task->getStatus()->value === "done") selected="selected" @endif>Done</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="button" class="btn btn-success" id="edit">Save Changes</button>
        </div>
    </form>
</x-guest-layout>
