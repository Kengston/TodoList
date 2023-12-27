<?php
/**
 * @var $tasks - All tasks on the page
 */
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

        /* Container */
        .container {
            width: 80%;
            margin: 20px auto;
        }

        /* Heading styles */
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
            position: relative;
        }

        /* Task content */
        .task-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        /* Description */
        .description {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        /* Task buttons */
        .task-buttons {
            display: flex;
            justify-content: flex-end;
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            padding: 0 10px;
            align-items: center;
        }

        /* Button styles */
        .delete-button,
        .edit-button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        .delete-button:hover,
        .edit-button:hover {
            color: red;
        }

        /* Add task form */
        .add-task-form {
            display: none;
            margin-bottom: 20px;
            clear: both;
            overflow: hidden;
        }

        .add-task-form input,
        .add-task-form textarea {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .add-task-form input:focus,
        .add-task-form textarea:focus {
            border-color: #4caf50;
            outline: none;
        }

        /* Add button style */
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

        /* Edit mode styles */
        .edit-mode .edit-form {
            display: block;
        }

        .edit-mode .edit-form input,
        .edit-mode .edit-form textarea {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #4caf50;
            width: calc(100% - 22px);
            box-sizing: border-box;
            background-color: #f9f9f9;
            color: #333;
            transition: border-color 0.3s ease;
        }

        .edit-mode .edit-form input:focus,
        .edit-mode .edit-form textarea:focus {
            border-color: #4caf50;
            outline: none;
        }

        .edit-mode .task-buttons .save-edit-button,
        .edit-mode .task-buttons .cancel-edit-button {
            background-color: transparent;
            color: #4caf50;
            border: none;
            padding: 8px 13px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
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
                    <?php if (!empty($task->task_name)): ?>
                        <p class="name"><?= $task->task_name ?></p>
                    <?php endif; ?>
                    <?php if (!empty($task->description)): ?>
                        <p class="description"><?= $task->description ?></p>
                    <?php endif; ?>
                </div>
                <div class="edit-form" style="display: none;">
                    <input class="edit-task-name" placeholder="<?= $task->task_name ?>">
                    <input class="edit-description" placeholder="<?= $task->description ?>">
                </div>
                <div class="task-buttons">
                    <div class="edit-buttons" style="display: none;">
                        <button class="cancel-edit-button" onclick="cancelEditedTask(<?= $task->id ?>)">
                            &#10060;
                        </button>
                        <button class="save-edit-button" onclick="saveEditedTask(<?= $task->id ?>)">
                            &#10004;
                        </button>
                    </div>
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
