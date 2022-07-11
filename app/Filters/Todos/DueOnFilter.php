<?php

namespace App\Filters\Todos;

class DueOnFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('due_on', '=', $value);
    }
}
