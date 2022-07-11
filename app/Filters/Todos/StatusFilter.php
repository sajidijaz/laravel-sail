<?php

namespace App\Filters\Todos;

class StatusFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('status', '=', $value);
    }
}
