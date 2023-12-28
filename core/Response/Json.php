<?php

namespace Mehdi\Core\Response;

class Json
{
    private string $jsonString;
    public function __construct($json)
    {
        $this->jsonString = json_encode($json);
    }

    public function __toString(): string
    {
        return $this->jsonString;
    }
}