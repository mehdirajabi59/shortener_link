<?php

namespace Mehdi\Core\Validator\Rules;

use Mehdi\Core\Validator\ValidatorInterface;

class Required implements ValidatorInterface
{
    private $value;
    public function __construct($value)
    {
        $this->value =  $value;
    }

    public function passes(): bool
    {
        return ! empty($this->value) ;
    }

    public function message($name): string
    {
        return sprintf('You must fill the %s', $name);
    }
}