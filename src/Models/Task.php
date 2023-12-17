<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    protected $table = 'tasks'; // Название таблицы в базе данных
    protected $fillable = ['task_name', 'description', 'status']; // Поля, доступные для заполнения
}
