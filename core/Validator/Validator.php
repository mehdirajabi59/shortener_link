<?php

namespace Mehdi\Core\Validator;

class Validator
{

    private array $classes;
    private array $errorMessages = [];

    public static function make(array $classes): self
    {
        $thisClass = new self();
        $thisClass->classes = $classes;

        return $thisClass;
    }

    public function validate(): bool
    {
        foreach ($this->classes as $inputName => $class) {
            if ($class instanceof ValidatorInterface) {
                if (! $class->passes()) {
                    array_push($this->errorMessages, [$inputName => $class->message($inputName)]);
                }
            }
        }

        return ! count($this->errorMessages);
    }

    public function getErrors()
    {
        return $this->errorMessages;
    }
}