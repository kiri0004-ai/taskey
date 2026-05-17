<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\ProjectController;
use App\Controllers\TagController;
use App\Controllers\TaskController;
use App\Controllers\UserController;
use App\Middleware\AuthMiddleware;
use App\Middleware\CsrfMiddleware;
use App\Models\User;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\TagRepository;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\CsrfService;
use Exception;
use Framework\Database;
use Framework\ResponseFactory;
use Framework\ServiceContainer;
use Framework\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @throws Exception
     */
    public function register(ServiceContainer $container): void
    {
        $responseFactory = $container->get(ResponseFactory::class);

        $database = $container->get(Database::class);

        $tagRepository = new TagRepository($database);

        $taskRepository = new TaskRepository($database, $tagRepository);
        $container->set(TaskRepositoryInterface::class, $taskRepository);

        $projectRepository = new ProjectRepository($database);
        $container->set(ProjectRepositoryInterface::class, $projectRepository);

        $userRepository = new UserRepository($database);

        $authService = new AuthService($userRepository);
        $authMiddleware = new AuthMiddleware($authService, $responseFactory);
        $container->set(AuthMiddleware::class, $authMiddleware);

        $csrfService = new CsrfService($responseFactory);
        $csrfMiddleware = new CsrfMiddleware($csrfService);
        $container->set(CsrfMiddleware::class, $csrfMiddleware);



        $tagController = new TagController($responseFactory, $tagRepository, $taskRepository);
        $container->set(TagController::class, $tagController);

        $homeController = new HomeController($responseFactory);
        $container->set(HomeController::class, $homeController);

        $taskController = new TaskController($responseFactory, $taskRepository, $projectRepository, $tagRepository, $userRepository);
        $container->set(TaskController::class, $taskController);

        $projectController = new ProjectController($responseFactory, $projectRepository, $taskRepository);
        $container->set(ProjectController::class, $projectController);

        $userController = new UserController($responseFactory, $userRepository, $authService);
        $container->set(UserController::class, $userController);

        $accessMiddleware = new Middleware\AccessMiddleware();
        $container->set(Middleware\AccessMiddleware::class, $accessMiddleware);
    }
}
