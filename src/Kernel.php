<?php

namespace Framework;

class Kernel
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function registerRoutes(RouteProviderInterface $routerProvider): void
    {
        $routerProvider->register($this->router);
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
