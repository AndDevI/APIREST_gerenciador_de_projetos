<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{
    protected $taskRepo;

    public function __construct(TaskRepository $taskRepo) {
        $this->taskRepo = $taskRepo;
    }

    public function getAllTasks() {
        return $this->taskRepo->all();
    }

    public function getTaskById($id) {
        return $this->taskRepo->find($id);
    }

    public function createTask(array $data) {
        return Task::create($data);
    }

    public function updateTask($id, array $data) {
        return $this->taskRepo->update($id, $data);
    }

    public function deleteTask($id) {
        return $this->taskRepo->delete($id);
    }
}
