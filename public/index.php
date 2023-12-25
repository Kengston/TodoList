<?php

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
$app->addBodyParsingMiddleware();

// List all tasks
$app->get('/tasks', function ($request, $response) {
    $tasks = Task::all();
    return $this->get('renderer')->render($response, 'tasks/index.php', ['tasks' => $tasks]);
});

// Show a specific task
$app->get('/tasks/{id}', function ($request, $response, $args) {
    return $this->get('renderer')->render($response, 'tasks/show.php', ['task' => Task::find($args['id'])]);
});

// Create a new task
$app->post('/tasks', function ($request, $response) {

    $postData = $request->getParsedBody();

    error_log(print_r($postData, true));

    if ($postData) {
        Task::create($postData);
        return $response->withRedirect('/tasks');
    } else {
        // Create a JSON response with a 400 status code (Bad Request)
        $response->getBody()->write(json_encode([
            'error' => 'Invalid request data. Please provide task_name and description.'
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

});

// Update an existing task
$app->put('/tasks/{id}', function ($request, $response, $args) {

    Task::find($args['id'])->update($request->getParsedBody());
    return $response->withRedirect('/tasks');
});

// Delete a task
$app->delete('/tasks/{id}', function ($request, $response, $args) {
    Task::find($args['id'])->delete();
    return $response->withRedirect('/tasks');
});


$app->run();