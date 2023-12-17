<?php
/**
 * @var $tasks - All tasks on page;
 * */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasks List</title>
</head>
<body>
<h1>Tasks List</h1>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li><?= $task->task_name ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>