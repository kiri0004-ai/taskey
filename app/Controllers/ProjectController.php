<?php

namespace App\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\TaskRepositoryInterface;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class ProjectController
{
    private ResponseFactory $responseFactory;
    private ProjectRepositoryInterface $projectRepository;
    private TaskRepositoryInterface $taskRepository;


    public function __construct(
        ResponseFactory $responseFactory,
        ProjectRepositoryInterface $projectRepository,
        TaskRepositoryInterface $taskRepository
    ) {
        $this->responseFactory = $responseFactory;
        $this->projectRepository = $projectRepository;
        $this->taskRepository = $taskRepository;
    }

    public function index(): Response
    {
        $projects = $this->projectRepository->all();
        return $this->responseFactory->view("projects/index.html.twig", ["projects" => $projects]);
    }

    public function create(): Response
    {
        return $this->responseFactory->view("projects/create.html.twig");
    }

    public function store(Request $request): Response
    {
        $title = $request->get('title');
        $description = $request->get('description') ?? '';

        $errors = [];
        if ($title === null || trim($title) === '') {
            $errors['title'] = "Title is required.";
            $title = null;
        }

        if ($description == null || trim($description) === '') {
            $errors['description'] = "Description is required.";
            $title = null;
        }
        $project = new Project();
        $project->title = $title ?? '';
        $project->description = $description;

        if (!empty($errors)) {
            return $this->responseFactory->view(
                "projects/create.html.twig",
                [
                    "errors" => $errors,
                    "project" => $project
                ]
            );
        }

        $project = $this->projectRepository->insert($project);
        if ($project === null) {
            return $this->responseFactory->internalError();
        }
        return $this->responseFactory->redirect('/projects/' . $project->id);
    }

    public function show(Request $request): Response
    {
        $projectId = (int)$request->get('id');
        $project = $this->projectRepository->find($projectId);

        if ($project === null) {
            return $this->responseFactory->notFound();
        }
        $tasks = $this->taskRepository->findProjectTasks($project);

        return $this->responseFactory->view("projects/show.html.twig", [
            "project" => $project,
                "tasks" => $tasks
            ]);
    }

    public function edit(Request $request): Response
    {
        $id = (int)$request->get('id');
        $project = $this->projectRepository->find($id);
        return $this->responseFactory->view('projects/edit.html.twig', [
            'project' => $project
        ]);
    }

    public function update(Request $request): Response
    {
        $id = (int)$request->get('id');
        $project = $this->projectRepository->find($id);
        if (!$project) {
            return $this->responseFactory->notFound();
        }

        $project->title = $request->get('title') ?? $project->title;
        $project->description = $request->get('description') ?? $project->description;

        $projectUpdate = $this->projectRepository->update($project);
        if (!$projectUpdate) {
            return $this->responseFactory->internalError();
        }
        return $this->responseFactory->redirect('/projects/' . $project->id);
    }

    public function deleteConfirm(Request $request): Response
    {
        $id = (int)$request->get('id');
        $project = $this->projectRepository->find($id);
        if (!$project) {
            return $this->responseFactory->notFound();
        }
        return $this->responseFactory->view('projects/delete.html.twig', [
            'project' => $project
        ]);
    }

    public function delete(Request $request): Response
    {
        $id = (int)$request->get('id');
        $project = $this->projectRepository->find($id);
        if (!$project) {
            return $this->responseFactory->notFound();
        }
        $isDeleted = $this->projectRepository->delete($project);
        if ($isDeleted) {
            return $this->responseFactory->redirect('/projects');
        }
        return $this->responseFactory->internalError();
    }
}
