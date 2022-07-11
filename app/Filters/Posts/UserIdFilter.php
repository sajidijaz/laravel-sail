<?php

namespace App\Filters\Posts;

class UserIdFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('user_id', '=', $value);
    }
}
