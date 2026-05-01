<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Task;
use App\Models\User;

// Auth Routes
Route::get('/login', function () {
    return view('auth');
})->name('login');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect('/');
})->name('register');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors(['login' => 'Invalid credentials.']);
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Task Routes (Protected by Auth)
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $tasks = Auth::user()->tasks()->latest()->get();
        return view('index', compact('tasks'));
    })->name('tasks.index');

    Route::post('/tasks', function (Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'scheduled_at' => 'nullable|date',
        ]);

        Auth::user()->tasks()->create([
            'title' => $request->title,
            'scheduled_at' => $request->scheduled_at,
        ]);

        return redirect()->back()->with('success', 'Task added successfully.');
    })->name('tasks.store');

    Route::patch('/tasks/{task}', function (Request $request, Task $task) {
        if ($task->user_id !== Auth::id()) abort(403);
        
        $task->update([
            'is_completed' => !$task->is_completed,
        ]);

        return redirect()->back()->with('success', 'Task updated successfully.');
    })->name('tasks.update');

    Route::delete('/tasks/{task}', function (Task $task) {
        if ($task->user_id !== Auth::id()) abort(403);
        
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    })->name('tasks.destroy');
});
