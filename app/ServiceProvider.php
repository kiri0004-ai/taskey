<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;
use Exception;
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

        $taskRepository = new TaskRepository();
        $container->set(TaskRepositoryInterface::class, $taskRepository);

        $homeController = new HomeController($responseFactory);
        $container->set(HomeController::class, $homeController);

        $taskController = new TaskController($responseFactory, $taskRepository);
        $container->set(TaskController::class, $taskController);
    }
}
