<?php

namespace App\Controllers;

use Framework\Response;
use Framework\ResponseFactory;

class TaskController
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function index(): Response
    {
        return $this->responseFactory->body("List all tasks");
    }

    public function create(): Response
    {
        return $this->responseFactory->body("Create new task");
    }
}
