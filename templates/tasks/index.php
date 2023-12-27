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
            justify-content: flex-end; /* Add this to align the content to the right */
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
            height: 100%; /* Занимаем всю высоту .task */
            padding: 0 10px; /* Добавьте отступы, чтобы кнопки не были прижаты к краям */
            align-items: center; /* Центрирование по вертикали */
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
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
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
        .edit-mode .task-content input,
        .edit-mode .task-content textarea {
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #4caf50;
            width: calc(100% - 20px);
            box-sizing: border-box;
            background-color: #f9f9f9;
            color: #333;
        }

        .edit-mode .task-content .edit-form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-right: 20px;
            box-sizing: border-box;
            width: calc(100% - 150px);
        }

        .edit-mode .task-content .edit-form .task-buttons {
            display: flex;
            justify-content: flex-end; /* Выравнивание в конец контейнера */
            margin-top: 10px;
            width: 100%; /* Ширина равна 100% */
            box-sizing: border-box; /* Размеры включают padding */
        }

        .edit-mode .task-content .edit-form .task-buttons button {
            margin-left: 10px;
            /* flex: 1; удаляем это свойство */
        }

        .edit-mode .task-buttons .edit-button,
        .edit-mode .task-buttons .delete-button {
            display: none;
        }

        .edit-mode .task-buttons .save-edit-button,
        .edit-mode .task-buttons .cancel-edit-button {
            background-color: transparent;
            color: #4caf50;
            border: none;
            padding: 8px 16px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-mode .task-buttons .save-edit-button:hover,
        .edit-mode .task-buttons .cancel-edit-button:hover {
            background-color: #4caf50;
            color: #fff;
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
                <div class="edit-form" style="display: none; padding-right: 50px;">
                    <input class="edit-task-name" value="<?= $task->task_name ?>">
                    <input class="edit-description" value="<?= $task->description ?>">
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
