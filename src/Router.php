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
                $response = new Response();
                $response->body = $route->return;
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
     * @param string $return Response body
     * @return void
     */
    public function addRoute(string $method, string $path, string $return): void
    {
        $route = new Route($method, $path, $return);
        $this->routes[] = $route;
    }
}
