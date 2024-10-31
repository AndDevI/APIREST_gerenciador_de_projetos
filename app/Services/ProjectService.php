<?php

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService
{
    protected $projectRepo;

    public function __construct(ProjectRepository $projectRepo) {
        $this->projectRepo = $projectRepo;
    }

    public function getAllProjects() {
        return $this->projectRepo->all();
    }

    public function getProjectById($id) {
        return $this->projectRepo->find($id);
    }

    public function createProject(array $data) {
        return $this->projectRepo->create($data);
    }

    public function updateProject($id, array $data) {
        return $this->projectRepo->update($id, $data);
    }

    public function deleteProject($id) {
        return $this->projectRepo->delete($id);
    }
}
