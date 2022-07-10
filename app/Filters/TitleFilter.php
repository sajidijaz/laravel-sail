<?php

namespace App\Filters;

class TitleFilter
{
    public function filter($builder, $value)
    {
        return $builder->orWhere('title', 'like', "%{$value}%");
    }
}
