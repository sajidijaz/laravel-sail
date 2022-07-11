<?php

namespace App\Filters\Posts;

use App\Filters\AbstractFilter;

class PostFilter extends AbstractFilter
{
    protected array $filters = [
        'userId' => UserIdFilter::class,
        'title' => TitleFilter::class,
        'body' => BodyFilter::class,
    ];
}
