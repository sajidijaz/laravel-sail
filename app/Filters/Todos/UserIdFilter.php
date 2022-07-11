<?php

namespace App\Filters\Todos;

class UserIdFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('user_id', '=', $value);
    }
}
