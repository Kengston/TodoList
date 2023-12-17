<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TaskController {
    public function getAllTasks(Request $request, Response $response) {
        // Получение всех задач из базы данных и возврат их в JSON
    }

    public function getTask(Request $request, Response $response, $args) {
        // Получение одной задачи из базы данных по ID и возврат ее в JSON
    }

    // Другие методы для создания, обновления и удаления задач
}