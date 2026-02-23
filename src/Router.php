<?php

namespace Framework;

class Router
{
    /** @var Route[] */
    private array $routes = [];

    public function __construct()
    {
    }

    /**
     * Dispatch the Request to the appropriate route and return a Response.
     *
     * @param Request $request
     * @return Response
     */
    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as $route) {
            if ($route->matches($request->method, $request->path)) {
                $callback = $route->callback;
                $response = $callback();
                return $response;
            }
        }

        // No matching route found, return a 404 response
        $response = new Response();
        $response->responseCode = 404;
        $response->body = "Page not found";
        return $response;
    }

    /**
     * Add a new route to the router.
     *
     * @param string $method HTTP method
     * @param string $path URL path
     * @param callable $callback Callback function to handle the route
     * @return void
     */
    public function addRoute(string $method, string $path, callable $callback): void
    {
        $route = new Route($method, $path, $callback);
        $this->routes[] = $route;
    }
}
