<?php

namespace App\Controllers;

use Framework\Response;

class HomeController
{
    public function index(): Response
    {
        $response = new Response();
        $response->body = "Home page";
        return $response;
    }

    public function about(): Response
    {
        $response = new Response();
        $response->body = "About page";
        return $response;
    }
}
