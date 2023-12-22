<?php
// Comment this line if exists
// session_start();


use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use DI\Container;
use App\Models\Task;

require __DIR__ . '/../vendor/autoload.php';


$container = new Container();
$container->set('renderer', function () {
    return new PhpRenderer(__DIR__ . '/../templates/');
});

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->get('/tasks', function ($request, $response)  {
    $tasks = Task::all();

    return $this->get('renderer')->render($response, 'tasks/index.php', ['tasks' => $tasks]);
});

$app->run();