<?php

namespace Framework;

class ResponseFactory
{
    private \Twig\Environment $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/views/');
        $twig = new \Twig\Environment($loader, [
            'debug' => true
        ]);
        $this->twig = $twig;
    }

    /**
     * @param string $view
     * @param array<mixed> $parameters
     * @return Response
     */
    public function view(string $view, mixed $parameters = []): Response
    {
        $response = new Response();

        try {
            $response->responseCode = 200;
            $response->body = $this->twig->render($view, $parameters);
            return $response;
        } catch (\Exception $e) {
            $response->responseCode = 500;
            $response->body = $e->getMessage();
            return $response;
        }
    }

    public function notFound(): Response
    {
        $response = new Response();
        try {
            $response->responseCode = 404;
            $response->body = $this->twig->render('404.html.twig');
            return $response;
        } catch (\Exception $e) {
            $response->responseCode = 500;
            $response->body = $e->getMessage();
            return $response;
        }
    }
}
