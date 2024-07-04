<!DOCTYPE html>
<html>
<head>
    <title>New Task Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            padding: 10px 0;
            background-color: #4CAF50;
            color: white;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .content {
            padding: 10px;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #4CAF50;
            color: white;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
            <h2>New Task Notification</h2>
        <div class="content">
            <h2>Welcome, {{ $admin->name }}!</h2>
            <p>We are pleased to inform you that a new task has been created.</p>
            <p><strong>Title:</strong> {{ $task->title }}</p>
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Timer:</strong> {{ convertTimerToHours($task->timer) }}</p>
        </div>
        <div>
            <h2>
                <p>Thank you for using our service.</p>
            </h2>
        </div>
    </div>
</body>
</html>

@php
function convertTimerToHours($timer)
{
    $parts = explode(':', $timer);
    $hours = (int) $parts[0];
    return $hours . ' hour' . ($hours > 1 ? 's' : '');
}
@endphp
