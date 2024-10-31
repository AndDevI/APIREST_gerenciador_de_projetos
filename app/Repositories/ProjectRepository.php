<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    protected $model;

    public function __construct(Project $project) {
        $this->model = $project;
    }

    public function all() {
        return $this->model->all();
    }

    public function find($id) {
        return $this->model->findOrFail($id);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update($id, array $data) {
        $project = $this->find($id);
        $project->update($data);
        return $project;
    }

    public function delete($id) {
        $project = $this->find($id);
        $project->delete();
        return $project;
    }
}
