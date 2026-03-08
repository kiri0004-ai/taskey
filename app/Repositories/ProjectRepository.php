<?php

namespace App\Repositories;

use App\Models\Project;
use Framework\Database;

class ProjectRepository implements ProjectRepositoryInterface
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @return Project[]
     */
    public function all(): array
    {
        $stmt = $this->database->run("SELECT * FROM projects")->fetchAll();
        $projects = [];
        foreach ($stmt as $row) {
            $projects[] = $this->fromDbRow($row);
        }
        return $projects;
    }

    public function find(int $id): ?Project
    {
        $stmt = $this->database->run("SELECT * FROM projects WHERE id = :id", ['id' => $id])->fetch();
        return $this->fromDbRow($stmt);
    }

    public function insert(Project $project): Project|null
    {
        $title = $project->title;
        $description = $project->description;
        $stmt = $this->database->run('INSERT INTO projects (title, description) VALUES (:title, :description)', [
            'title' => $title,
            'description' => $description
        ]);
        $projectId = $this->database->getLastID();

        $project = new Project();
        $project->id = $projectId;
        $project->title = $title;
        $project->description = $description;

        return $project;
    }

    public function update(Project $project): bool
    {
        $stmt = $this->database->run(
            'UPDATE projects SET title = :title, description = :description WHERE id = :id',
            [
                'title' => $project->title,
                'description' => $project->description,
                'id' => $project->id
            ]
        );
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function delete(Project $project): bool
    {
        $projectId = $project->id;
        $stmt = $this->database->run('DELETE FROM projects WHERE id = :id', ['id' => $projectId]);
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param mixed $row
     * @return Project
     */
    private function fromDbRow(mixed $row): Project
    {
        $project = new Project();
        $project->id = $row->id;
        $project->title = $row->title;
        $project->description = $row->description;
        return $project;
    }
}
