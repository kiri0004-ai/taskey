<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Task;

interface ProjectRepositoryInterface
{
    /** @return Project[] */
    public function all(): array;
    public function find(int $id): ?Project;
    public function insert(Project $project): Project|null;
    public function update(Project $project): bool;
    public function delete(Project $project): bool;
}