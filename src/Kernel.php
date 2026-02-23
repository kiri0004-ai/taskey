<?php

namespace Framework;

class Kernel
{
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $response = new Response(body: "Thank you for your request");
        return  $response;
    }
}