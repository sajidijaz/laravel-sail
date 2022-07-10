<?php

namespace App\Filters;

class BodyFilter
{
    public function filter($builder, $value)
    {
        return $builder->orWhere('body', 'like', "%{$value}%");
    }
}
