<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'To-Do List')</title>
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
        @yield('content')
    </div>

</body>
</html>
