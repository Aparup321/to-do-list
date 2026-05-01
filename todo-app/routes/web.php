<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;

Route::get('/', function () {
    $tasks = Task::latest()->get();
    return view('tasks.index', compact('tasks'));
})->name('tasks.index');

Route::post('/tasks', function (Request $request) {
    $request->validate([
        'title' => 'required|string|max:255',
        'scheduled_at' => 'nullable|date',
    ]);

    Task::create([
        'title' => $request->title,
        'scheduled_at' => $request->scheduled_at,
    ]);

    return redirect()->back()->with('success', 'Task added successfully.');
})->name('tasks.store');

Route::patch('/tasks/{task}', function (Request $request, Task $task) {
    $task->update([
        'is_completed' => !$task->is_completed,
    ]);

    return redirect()->back()->with('success', 'Task updated successfully.');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->back()->with('success', 'Task deleted successfully.');
})->name('tasks.destroy');
