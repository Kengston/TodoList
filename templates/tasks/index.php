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
    <style>
        /* Стили для улучшения внешнего вида */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Цвет фона */
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }


        h1 {
            text-align: center;
            color: #333;
        }


        .task {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px;
            transition: all 0.3s ease-in-out; /* Анимация удаления */
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
            color: red; /* Изменение цвета при наведении */
        }
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
        }
        .add-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>TODO List</h1>
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
    <button class="add-button" onclick="addTask()">Add Task</button>
</div>

<!-- JavaScript для обработки действий добавления, удаления и редактирования задач -->
<script>
    function addTask() {
        // Здесь можно добавить логику добавления новой задачи
        console.log('Добавить новую задачу');
    }

    function deleteTask(taskId) {
        const taskElement = document.getElementById('task-' + taskId);
        taskElement.style.transform = 'translateX(-200%)'; // Анимация удаления
        setTimeout(() => {
            taskElement.remove(); // Удаление элемента после анимации
            // Здесь можно добавить логику удаления задачи с taskId из базы данных
        }, 300); // Время анимации в миллисекундах
    }

    function editTask(taskId) {
        // Здесь можно добавить логику для редактирования задачи с taskId
        console.log('Редактировать задачу с ID:', taskId);
    }
</script>
</body>
</html>
