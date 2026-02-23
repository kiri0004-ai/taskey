<?php

namespace Framework;

class Response
{

    public int $responseCode;

    public string $body;

    public ?string $header;

    public function __construct(string $body, int $responseCode = 200, ?string $header = null)
    {
        $this->responseCode = $responseCode;
        $this->body = $body;
        $this->header = $header;
    }

    public function echo(): void
    {
        echo $this->body;
        //TODO: Add responce code and headers.
        if ($this->header) {
        }
    }
}
