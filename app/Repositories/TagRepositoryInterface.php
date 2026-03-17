<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;

interface TagRepositoryInterface
{
    /** @return Tag[] */
    public function all(): array;
    public function find(int $id): ?Tag;
    public function insert(Tag $tag): Tag|null;
    public function update(Tag $tag): bool;
    public function delete(Tag $tag): bool;

    /** @return Tag[] */
    public function findProjectTasks(Project $project): array;
}
