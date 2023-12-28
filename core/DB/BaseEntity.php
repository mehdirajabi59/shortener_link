<?php

namespace Mehdi\Core\DB;

class BaseEntity
{
    public function setAttributes(array $columns): void
    {
        foreach ($columns as $column => $value) {
            $columnCamel = $this->snakeToCamel($column);

            if (property_exists($this, $columnCamel)){
                $this->{$columnCamel} = $value;
            }
        }
    }

    private  function snakeToCamel($input): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }
}