<?php

namespace Mehdi\Core\Validator\Rules;

use Mehdi\Core\Validator\ValidatorInterface;

class UrlValidator implements ValidatorInterface
{

    private string $value;
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function passes(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_URL);
    }

    public function message($name): string
    {
       return "Your {$name} is invalid url";
    }
}