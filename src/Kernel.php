<?php

namespace Framework;

class Kernel
{
    public function __construct()
    {
    }

    /**
     * Handle the incoming Request and produce a Response.
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $response = new Response();
        $response->body = "Thank you for your request! You requested: " . $request->path;
        return $response;
    }
}
