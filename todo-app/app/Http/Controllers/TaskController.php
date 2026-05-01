<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = \App\Models\Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        \App\Models\Task::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Task added successfully.');
    }

    public function update(Request $request, \App\Models\Task $task)
    {
        $task->update([
            'is_completed' => !$task->is_completed,
        ]);

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    public function destroy(\App\Models\Task $task)
    {
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
