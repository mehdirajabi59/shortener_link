<?php

namespace Mehdi\Core\Validator;

interface ValidatorInterface
{
    public function __construct($value);
    public function passes() : bool;

    public function message(): string;
}