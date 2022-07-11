<?php

namespace App\Filters\Posts;

class TitleFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('title', 'like', "%{$value}%");
    }
}
