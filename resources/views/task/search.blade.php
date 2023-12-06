<div class="container mb-5">
    <form>
        <div class="flex">
            <div class="flex-none w-full h-14 mr-5">
                <input class="w-full" type="text" id="byText" name="byText"/>
            </div>
            <div class="flex-initial w-20 ...">
                <button class="btn btn-success" type="submit" id="search">Search</button>
            </div>
        </div>
        <div class="flex">
            <div class="flex-none w-1/3 h-14 mr-5">
                <label class="mr-2">Status:</label>
                <input type="radio" class="bg-slate-300" id="toDo" name="byStatus" value="toDo">
                <label for="toDo">ToDo</label>
                <input type="radio" class="bg-slate-300" id="done" name="byStatus" value="done">
                <label for="done">Done</label>
                <br>
                <label class="mr-2">Priority:</label>
                <input type="radio" class="bg-slate-300" id="one" name="byPriority" value="1">
                <label class="mr-3" for="1">1</label>
                <input type="radio" class="bg-slate-300" id="two" name="byPriority" value="2">
                <label class="mr-3" for="2">2</label>
                <input type="radio" class="bg-slate-300" id="three" name="byPriority" value="3">
                <label class="mr-3" for="3">3</label>
                <input type="radio" class="bg-slate-300" id="four" name="byPriority" value="4">
                <label class="mr-3" for="4">4</label>
                <input type="radio" class="bg-slate-300" id="five" name="byPriority" value="5">
                <label class="mr-3" for="5">5</label>
            </div>
            <div class="flex-initial w-1/3 ...">
                <label class="mr-2">Sort by Status:</label>
                <input type="radio" class="bg-slate-300" id="toDo" name="sortByStatus" value="1">
                <label for="toDo">Ascending</label>
                <input type="radio" class="bg-slate-300" id="done" name="sortByStatus" value="0">
                <label for="done">Descending</label>
                <br>
                <label class="mr-2">Sort by Priority:</label>
                <input type="radio" class="bg-slate-300" id="toDo" name="sortByPriority" value="1">
                <label for="toDo">Ascending</label>
                <input type="radio" class="bg-slate-300" id="done" name="sortByPriority" value="0">
                <label for="done">Descending</label>
            </div>
            <div class="flex-initial w-1/3 ...">
                <label class="mr-2">Sort by CreatedAt:</label>
                <input type="radio" class="bg-slate-300" id="toDo" name="sortByCreatedAt" value="1">
                <label for="toDo">Ascending</label>
                <input type="radio" class="bg-slate-300" id="done" name="sortByCreatedAt" value="0">
                <label for="done">Descending</label>
                <br>
                <label class="mr-2">Sort by CompletedAt:</label>
                <input type="radio" class="bg-slate-300" id="toDo" name="sortByCompletedAt" value="1">
                <label for="toDo">Ascending</label>
                <input type="radio" class="bg-slate-300" id="done" name="sortByCompletedAt" value="0">
                <label for="done">Descending</label>
            </div>
        </div>
    </form>
</div>
