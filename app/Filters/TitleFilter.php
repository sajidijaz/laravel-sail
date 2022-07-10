<?php

namespace App\Filters;

class TitleFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('title', 'like', "%{$value}%");
    }
}
