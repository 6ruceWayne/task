<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(
    function () {
        Route::name('tasks.')->prefix('tasks')->group(
            function () {
                Route::get('/getBySearchFilter', [TasksController::class, 'getBySearchFilter'])->name('getBySearchFilter');
                Route::post('/', [TasksController::class, 'store'])->name('store');
                Route::put('/', [TasksController::class, 'update'])->name('update');
                Route::delete('/', [TasksController::class, 'destroy'])->name('destroy');
            }
        );
    }
);
