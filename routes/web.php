<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [TaskController::class, 'index'])->name('task');
Route::get('/new-task', [TaskController::class, 'create'])->name('new-task');
Route::post('/new-task', [TaskController::class, 'store'])->name('store-task');
Route::get('/edit-task/{id}', [TaskController::class, 'edit'])->name('edit-task');
Route::post('/edit-task/{id}', [TaskController::class, 'update'])->name('update-task');
Route::get('/delete-task/{id}', [TaskController::class, 'destroy'])->name('delete-task');
Route::get('/update-priority', [TaskController::class, 'updatePriority'])->name('update-priority');



Route::get('/project', [ProjectController::class, 'index'])->name('project');
Route::get('/new-project', [ProjectController::class, 'create'])->name('new-project');
Route::post('/new-project', [ProjectController::class, 'store'])->name('store-project');
Route::get('/edit-project/{id}', [ProjectController::class, 'edit'])->name('edit-project');
Route::post('/edit-project/{id}', [ProjectController::class, 'update'])->name('update-project');
Route::get('/delete-project/{id}', [ProjectController::class, 'destroy'])->name('delete-project');