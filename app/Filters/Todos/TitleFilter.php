<?php

namespace App\Filters\Todos;

class TitleFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('title', 'like', "%{$value}%");
    }
}
