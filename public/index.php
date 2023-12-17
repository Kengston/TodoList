<?php
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use DI\Container;
use App\Models\Task;

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

session_start();

$container->set('renderer', function () {
    return new PhpRenderer(__DIR__ . "/../templates");
});

$app->get('/tasks', function ($request, $response, $args = []){
   $tasks = Task::getAllTasks();

   return $this->get('renderer')->render($response, 'tasks/index.php', ['tasks' => $tasks]);
});

$app->run();