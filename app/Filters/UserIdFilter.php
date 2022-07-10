<?php

namespace App\Filters;

class UserIdFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('user_id', '=', $value);
    }
}
