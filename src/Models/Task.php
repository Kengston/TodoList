<?php

namespace App\Models;
require __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class Task extends Model {
    protected $table = 'todos'; // Название таблицы в базе данных
    protected $fillable = ['task_name', 'description', 'status']; // Поля, доступные для заполнения

    public static function boot() {
        parent::boot();
        $capsule = new Capsule();
        $capsule->addConnection(require __DIR__ . '/../../config/database.php');
        $capsule->bootEloquent();
    }

    public static function getAllTasks() {
        return self::all();
    }
}
