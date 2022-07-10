<?php

namespace App\Filters;

class PostFilter extends AbstractFilter
{
    protected array $filters = [
        'user_id' => UserIdFilter::class,
        'title' => TitleFilter::class,
        'body' => BodyFilter::class,
    ];
}
