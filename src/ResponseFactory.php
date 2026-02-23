<?php

namespace Framework;

class ResponseFactory
{
    public function body(string $body): Response
    {
        $response = new Response();
        $response->responseCode = 200;
        $response->body = $body;
        return $response;
    }

    public function notFound(): Response
    {
        $response = new Response();
        $response->responseCode = 404;
        $response->body = "Page not found.";
        return $response;
    }
}
