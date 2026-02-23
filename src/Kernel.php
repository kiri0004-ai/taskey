<?php

namespace Framework;

class Kernel
{
    private Router $router;

    private ServiceContainer $container;

    public function __construct()
    {
        $this->router = new Router();
        $this->container = new ServiceContainer();
    }

    public function registerRoutes(RouteProviderInterface $routerProvider): void
    {
        $routerProvider->register($this->router, $this->container);
    }

    public function registerServices(ServiceProviderInterface $serviceProvider): void
    {
        $serviceProvider->register($this->container);
    }

    /**
     * Handle the incoming Request and produce a Response.
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        return $this->router->dispatch($request);
    }
}
