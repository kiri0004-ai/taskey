<?php

namespace Framework;

class Kernel
{
    private Router $router;

    private ServiceContainer $container;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->container = new ServiceContainer();

        $responseFactory = new ResponseFactory();
        $this->container->set(ResponseFactory::class, $responseFactory);

        $this->router = new Router($responseFactory);
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
