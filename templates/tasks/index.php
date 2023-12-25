<?php
/**
 * @var $tasks - All tasks on page;
 * */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TODO List</title>
    <script src="/JS/taskFunctions.js"></script>
    <script src="/JS/uiFunctions.js"></script>
    <style>
        /* Base styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }

        /* Task styles */
        .task {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px;
            transition: all 0.3s ease-in-out;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }
        .task-content {
            flex-grow: 1;
        }
        .description {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
        .task-buttons {
            display: flex;
            align-items: center;
        }

        /* Button styles */
        .delete-button,
        .edit-button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
        }
        .delete-button:hover,
        .edit-button:hover {
            color: red;
        }

        /* Form Styles */
        .add-task-form {
            display: none;
            margin-bottom: 20px;
            clear: both;
            overflow: hidden;
        }

        .add-task-form input,
        .add-task-form textarea {
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
        }

        /* Add button Style */
        .add-button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            float: right;
            display: block;
            clear: both;
            width: auto;
        }

        .add-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>TODO List</h1>
    <div class="add-task-form" id="addTaskForm" style="display: none;">
        <input type="text" id="taskName" placeholder="Task Name">
        <textarea id="taskDescription" placeholder="Task Description"></textarea>
        <button class="add-button" onclick="saveTask()">Save Task</button>
    </div>
    <ul id="task-list">
        <?php foreach ($tasks as $task): ?>
            <li class="task" id="task-<?= $task->id ?>">
                <div class="task-content">
                    <?= $task->task_name ?>
                    <?php if (!empty($task->description)): ?>
                        <p class="description"><?= $task->description ?></p>
                    <?php endif; ?>
                </div>
                <div class="task-buttons">
                    <button class="delete-button" onclick="deleteTask(<?= $task->id ?>)">
                        &#10060;
                    </button>
                    <button class="edit-button" onclick="editTask(<?= $task->id ?>)">
                        &#9998;
                    </button>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <button class="add-button" onclick="toggleAddTaskForm()">Add Task</button>
</div>

</body>
</html>
