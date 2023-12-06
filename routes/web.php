<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name('tasks.')->prefix('tasks')->group(
        function () {
            Route::get('/create/{parentId?}', [TasksController::class, 'create'])->name('create');
            Route::get('/show/{id?}', [TasksController::class, 'show'])->name('show');
            Route::get('/{id}', [TasksController::class, 'edit'])->name('edit');
        }
    );
});

Route::get('/', [TasksController::class, 'index'])->name('task.index');

require __DIR__.'/auth.php';
