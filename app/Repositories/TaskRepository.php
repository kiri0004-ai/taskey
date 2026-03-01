<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    /** @var array<int, mixed> */
    private array $tempTasks = array(
        array(
            "id" => 1,
            "title" => "Form the Fellowship",
            "description" => "Assemble representatives of the Free Peoples in Rivendell",
            "priority" => 3,
            "status" => 4,
            "progress" => 100,
            "created_at" => 1008710400,
            "completed_at" => 1008720400),
        array(
            "id" => 2,
            "title" => "Cross the Misty Mountains",
            "description" => "Find a safe passage through or around the mountains",
            "priority" => 2,
            "status" => 1,
            "progress" => 50,
            "created_at" => 1008720400,
            "completed_at" => null),
        array(
            "id" => 3,
            "title" => "Enter Moria",
            "description" => "Take the risky path through the Mines of Moria",
            "priority" => 2,
            "status" => 3,
            "progress" => 0,
            "created_at" => 1008740400,
            "completed_at" => null)
    );

    /**
     * @return Task[]
     */
    public function all(): array
    {
        $tasks = array();
        foreach ($this->tempTasks as $tempElement) {
            $task = new Task();
            $task->id = $tempElement['id'];
            $task->title = $tempElement['title'];
            $task->description = $tempElement['description'];
            $task->priority = $tempElement['priority'];
            $task->status = $tempElement['status'];
            $task->progress = $tempElement['progress'];
            $task->createdAt = $tempElement['created_at'];
            $task->completedAt = $tempElement['completed_at'];
            $tasks[] = $task;
        }

        return $tasks;
    }

    public function find(int $id): ?Task
    {
        $task = new Task();
        foreach ($this->tempTasks as $tempElement) {
            if ($tempElement['id'] === $id) {
                $task->id = $tempElement['id'];
                $task->title = $tempElement['title'];
                $task->description = $tempElement['description'];
                $task->priority = $tempElement['priority'];
                $task->status = $tempElement['status'];
                $task->progress = $tempElement['progress'];
                $task->createdAt = $tempElement['created_at'];
                $task->completedAt = $tempElement['completed_at'];
                return $task;
            }
        }
        return null;
    }
}
