<x-guest-layout>
    <form>
        @csrf
        <input type="hidden" id="parentId" value="{{$parentId}}">
        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea rows="7" id="description" class="block mt-1 w-full" type="text" name="description" required autofocus></textarea>
        </div>

        <div>
            <x-input-label for="description" :value="__('Priority')" />
            <select name="priority" id="priority">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
                <option value="4">Four</option>
                <option value="5">Five</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type = "button" class="btn btn-success" id="addnew">Submit</button>
        </div>
    </form>
</x-guest-layout>
