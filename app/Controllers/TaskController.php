<?php

namespace App\Controllers;

use Framework\Response;

class TaskController
{
    public function index(): Response
    {
        $response = new Response();
        $response->body = "List all tasks";
        return $response;
    }

    public function create(): Response
    {
        $response = new Response();
        $response->body = "Create new task";
        return $response;
    }
}
