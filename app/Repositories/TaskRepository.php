<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{


    public function find(int $id): Task
    {
        $task = new Task();
        foreach ($task->getFillable() as $field) {
    }
}