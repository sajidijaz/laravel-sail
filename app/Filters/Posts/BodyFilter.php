<?php

namespace App\Filters\Posts;

class BodyFilter
{
    public function filter($builder, $value)
    {
        return $builder->orWhere('body', 'like', "%{$value}%");
    }
}
