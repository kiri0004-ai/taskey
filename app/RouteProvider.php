<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\ProjectController;
use App\Controllers\TagController;
use App\Controllers\TaskController;
use App\Controllers\UserController;
use App\Middleware\AccessMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\CsrfMiddleware;
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
//        $accessMiddleware = $container->get(AccessMiddleware::class);
//        $router->addMiddleware([$accessMiddleware, 'handle']);
        $authMiddleware = $container->get(AuthMiddleware::class);

        $homeController = $container->get(HomeController::class);
        $router->addRoute('GET', '/', [$homeController, "index"]);
        $router->addRoute('GET', '/about', [$homeController, "about"]);

        $taskController = $container->get(TaskController::class);
        $router->addRoute('GET', '/tasks', [$taskController, "index"]);
        $router->addRoute('GET', '/tasks/(?<id>\d+)', [$taskController, "show"]);
        $router->addRoute('GET', '/tasks/create', [$taskController, "create"])->addMiddleware([$authMiddleware, 'requireAuth']);
        $router->addRoute('POST', '/tasks', [$taskController, 'store'])->addMiddleware([$authMiddleware, 'requireAuth']);
        $router->addRoute('GET', '/tasks/(?<id>\d+)/edit', [$taskController, 'edit'])->addMiddleware([$authMiddleware, 'requireAuth']);
        $router->addRoute('POST', '/tasks/(?<id>\d+)/edit', [$taskController, 'update'])->addMiddleware([$authMiddleware, 'requireAuth']);
        $router->addRoute('GET', '/tasks/(?<id>\d+)/delete', [$taskController, 'deleteConfirm'])->addMiddleware([$authMiddleware, 'requireAuth']);
        $router->addRoute('POST', '/tasks/(?<id>\d+)/delete', [$taskController, 'delete'])->addMiddleware([$authMiddleware, 'requireAuth']);

        $projectController = $container->get(ProjectController::class);
        $router->addRoute('GET', '/projects', [$projectController, 'index']);
        $router->addRoute('GET', '/projects/(?<id>\d+)', [$projectController, 'show']);
        $router->addRoute('GET', '/projects/create', [$projectController, 'create'])->addMiddleware([$authMiddleware, 'requireAdmin']);
        $router->addRoute('POST', '/projects', [$projectController, 'store'])->addMiddleware([$authMiddleware, 'requireAdmin']);
        $router->addRoute('GET', '/projects/(?<id>\d+)/edit', [$projectController, 'edit'])->addMiddleware([$authMiddleware, 'requireAdmin']);
        $router->addRoute('POST', '/projects/(?<id>\d+)/edit', [$projectController, 'update'])->addMiddleware([$authMiddleware, 'requireAdmin']);
        $router->addRoute('POST', '/projects/(?<id>\d+)/delete', [$projectController, 'delete'])->addMiddleware([$authMiddleware, 'requireAdmin']);

        $tagController = $container->get(TagController::class);
        $router->addRoute('GET', '/tags', [$tagController, 'index']);
        $router->addRoute('GET', '/tags/create', [$tagController, 'create']);
        $router->addRoute('POST', '/tags', [$tagController, 'store']);
        $router->addRoute('GET', '/tags/(?<id>\d+)', [$tagController, 'show']);
        $router->addRoute('GET', '/tags/(?<id>\d+)/edit', [$tagController, 'edit']);
        $router->addRoute('POST', '/tags/(?<id>\d+)/edit', [$tagController, 'update']);
        $router->addRoute('GET', '/tags/(?<id>\d+)/delete', [$tagController, 'delete']);

        $userController = $container->get(UserController::class);
        $router->addRoute('GET', '/register', [$userController, 'registerForm']);
        $router->addRoute('POST', '/register', [$userController, 'register']);
        $router->addRoute('GET', '/login', [$userController, 'loginForm']);
        $router->addRoute('POST', '/login', [$userController, 'login']);
        $router->addRoute('GET', '/logout', [$userController, 'logout']);

        $router->addMiddleware([$authMiddleware, 'handle']);

        $csrfMiddleware = $container->get(CsrfMiddleware::class);
        $router->addMiddleware([$csrfMiddleware, 'handle']);
    }
}
