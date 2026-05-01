<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            color: #333;
        }

        h1 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .task-form {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        .task-input {
            flex: 1;
            padding: 8px;
            font-size: 16px;
        }

        .btn {
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
        }

        .tasks-list {
            list-style: none;
            padding: 0;
        }

        .task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border: 1px solid #eee;
            margin-bottom: 10px;
            background: #fafafa;
        }

        .task-item.completed span {
            text-decoration: line-through;
            color: #888;
        }

        .task-content {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            margin: 0;
        }

        .task-actions form {
            margin: 0;
        }

        .btn-delete {
            background-color: #ff4444;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 12px;
        }

        .empty-state {
            color: #666;
            font-style: italic;
        }

        .task-input-time {
            padding: 8px;
            font-size: 14px;
            color: #555;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .task-details {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .task-title {
            font-weight: 500;
        }

        .task-time {
            font-size: 12px;
            color: #888;
            margin-top: 2px;
        }
    </style>
</head>
<body>

    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ccc; margin-bottom: 20px; padding-bottom: 10px;">
            <span style="font-size: 14px; color: #666;">Hello, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #ff4444; cursor: pointer; text-decoration: underline; font-size: 14px;">Logout</button>
            </form>
        </div>

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
    </div>

</body>
</html>
