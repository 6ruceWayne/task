@php
    use \App\Models\Task;
    /* @var Task $task */
@endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tasks</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css"
          rel="stylesheet">
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
@include('layouts.navigation')


@auth
    @include('task.search')
@endauth

<div class="container">
    @auth
        <div class="tree">
            @include('task.tasks-list-widget',['tasks' => $tasks])
        </div>
        {{ $tasks->appends(request()->all())->links() }}
    @elseguest
        <div>Register/Login to create Tasks</div>
    @endguest
</div>
</body>
</html>
