@extends('layouts.app')

@section('title', 'To-Do List')

@section('content')
    <h1>To-Do List</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="task-form">
        @csrf
        <input type="text" name="title" class="task-input" placeholder="What needs to be done?" required autofocus autocomplete="off">
        <input type="datetime-local" name="scheduled_at" class="task-input-time" aria-label="Schedule Task" title="Schedule Date & Time">
        <button type="submit" class="btn">Add Task</button>
    </form>

    @if($tasks->count() > 0)
        <ul class="tasks-list">
            @foreach($tasks as $task)
                <li class="task-item {{ $task->is_completed ? 'completed' : '' }}">
                    
                    <form action="{{ route('tasks.update', $task) }}" method="POST" class="task-content">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                        <div class="task-details">
                            <span class="task-title">{{ $task->title }}</span>
                            @if($task->scheduled_at)
                                <span class="task-time">📅 {{ $task->scheduled_at->format('M d, Y g:i A') }}</span>
                            @endif
                        </div>
                    </form>

                    <div class="task-actions">
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="empty-state">No tasks yet.</p>
    @endif
@endsection
