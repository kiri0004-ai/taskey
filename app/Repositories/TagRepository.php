<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Tag;
use Framework\Database;

class TagRepository implements TagRepositoryInterface
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @return Tag[]
     */
    public function all(): array
    {
        $stmt = $this->database->run("SELECT * FROM tags")->fetchAll();
        $tags = [];
        foreach ($stmt as $row) {
            $tag = $this->fromDbRow($row);
            $tags[] = $tag;
        }
        return $tags;
    }

    public function find(int $id): ?Tag
    {
        $stmt = $this->database->run("SELECT * FROM tags WHERE id = :id", ["id" => $id])->fetch();
        if (!$stmt) {
            return null;
        }
        $tag = $this->fromDbRow($stmt);
        return $tag;
    }


    public function insert(Tag $tag): Tag|null
    {
        $stmt = $this->database->run(
            "INSERT INTO tags (title, description, priority, status, progress, created_at, completed_at) 
                 VALUES (:title, :description, :priority, :status, :progress, :created_at, :completed_at)",
            [
                "title" => $tag->title,
                "description" => $tag->description,
                "priority" => $tag->priority,
                "status" => $tag->status,
                "progress" => $tag->progress,
                "created_at" => $tag->createdAt,
                "completed_at" => $tag->completedAt
            ]
        );
        if ($stmt->rowCount() === 0) {
            return null;
        }
        $tag->id = $this->database->getLastID();
        return $tag;
    }

    public function update(Tag $tag): bool
    {
        $stmt = $this->database->run(
            "UPDATE tags SET title = :title,
                description = :description,
                priority = :priority,
                status = :status,
                progress = :progress,
                created_at = :created_at,
                completed_at = :completed_at
             WHERE id = :id",
            [
                "id" => $tag->id,
                "title" => $tag->title,
                "description" => $tag->description,
                "priority" => $tag->priority,
                "status" => $tag->status,
                "progress" => $tag->progress,
                "created_at" => $tag->createdAt,
                "completed_at" => $tag->completedAt
            ]
        );
        return $stmt->rowCount() > 0;
    }

    /**
     * @param mixed $row
     * @return Tag
     */
    private function fromDbRow(mixed $row): Tag
    {
        $tag = new Tag();
        $tag->id = $row->id;
        $tag->title = $row->title;
        return $tag;
    }

    public function delete(Tag $tag): bool
    {
        $stmt = $this->database->run("DELETE FROM tags WHERE id = :id", ["id" => $tag->id]);

        return $stmt->rowCount() > 0;
    }
    /**
     * @return Tag[]
     */

    public function findProjectTags(Project $project): array
    {
        $stmt = $this->database->run(
            "SELECT * FROM tags WHERE project_id = :project_id",
            [
                'project_id' => $project->id]
        )->fetchAll();

        $tags = [];
        foreach ($stmt as $row) {
            $tags[] = $this->fromDbRow($row);
        }
        return $tags;
    }

    public function findProjectTasks(Project $project): array
    {
        // TODO: Implement findProjectTasks() method.
    }
}