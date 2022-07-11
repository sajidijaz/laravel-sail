<?php

namespace App\Filters\Todos;

use App\Filters\AbstractFilter;

class TodoFilter extends AbstractFilter
{
    protected array $filters = [
        'userId' => UserIdFilter::class,
        'title' => TitleFilter::class,
        'status' => StatusFilter::class,
        'dueOn' => DueOnFilter::class,
    ];
}
