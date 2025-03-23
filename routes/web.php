<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Inertia\Inertia;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks/reorder', [TaskController::class, 'reorder']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

Route::resource('tasks', TaskController::class)->only(['store', 'update', 'destroy']);
