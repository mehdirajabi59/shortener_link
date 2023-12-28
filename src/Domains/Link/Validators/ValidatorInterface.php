<?php

namespace Mehdi\ShortenerLink\Domains\Link\Validators;

interface ValidatorInterface
{
    public function passes($value) : bool;

    public function message(): string;
}