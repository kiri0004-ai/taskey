<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\ProjectController;
use App\Controllers\TaskController;
use Framework\Router;
use Framework\RouteProviderInterface;
use Framework\ServiceContainer;

class RouteProvider implements RouteProviderInterface
{
    /**
     * @throws \Exception
     */
    public function register(Router $router, ServiceContainer $container): void
    {
        $homeController = $container->get(HomeController::class);
        $router->addRoute('GET', '/', [$homeController, "index"]);
        $router->addRoute('GET', '/about', [$homeController, "about"]);

        $taskController = $container->get(TaskController::class);
        $router->addRoute('GET', '/tasks', [$taskController, "index"]);
        $router->addRoute('GET', '/tasks/(?<id>\d+)', [$taskController, "show"]);
        $router->addRoute('GET', '/tasks/create', [$taskController, "create"]);
        $router->addRoute('POST', '/tasks', [$taskController, 'store']);
        $router->addRoute('GET', '/tasks/(?<id>\d+)/edit', [$taskController, 'edit']);
        $router->addRoute('POST', '/tasks/(?<id>\d+)/edit', [$taskController, 'update']);
        $router->addRoute('GET', '/tasks/(?<id>\d+)/delete', [$taskController, 'deleteConfirm']);
        $router->addRoute('POST', '/tasks/(?<id>\d+)/delete', [$taskController, 'delete']);

        $projectController = $container->get(ProjectController::class);
        $router->addRoute('GET', '/projects', [$projectController, "index"]);
        $router->addRoute('GET', '/projects/(?<id>\d+)', [$projectController, "show"]);
        $router->addRoute('GET', '/projects/create', [$projectController, "create"]);
        $router->addRoute('POST', '/projects', [$projectController, 'store']);
        $router->addRoute('GET', '/projects/(?<id>\d+)/edit', [$projectController, 'edit']);
        $router->addRoute('POST', '/projects/(?<id>\d+)/edit', [$projectController, 'update']);
        $router->addRoute('GET', '/projects/(?<id>\d+)/delete', [$projectController, 'deleteConfirm']);
        $router->addRoute('POST', '/projects/(?<id>\d+)/delete', [$projectController, 'delete']);
    }
}
