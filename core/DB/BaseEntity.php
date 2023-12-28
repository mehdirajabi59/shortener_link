<?php

namespace Mehdi\Core\DB;

class BaseEntity
{
    private $isEmpty = true;
    public function setAttributes(bool|array $columns): void
    {
        if (! is_array($columns)) return;

        foreach ($columns as $column => $value) {
            $columnCamel = $this->snakeToCamel($column);

            if (property_exists($this, $columnCamel)){
                $this->{$columnCamel} = $value;
            }
        }
        $this->isEmpty = false;
    }

    public function isEmpty(): bool
    {
        return $this->isEmpty;
    }

    private  function snakeToCamel($input): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }

    public function __call(string $name , array $arguments)
    {
        if (preg_match('/^get.+$/', $name)){
            $propertyName = lcfirst(substr($name, 3));
            if (property_exists($this, $propertyName)){
                return $this->{$propertyName};
            }
        }
    }
}