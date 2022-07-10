<?php

namespace App\Filters;

class PostFilter extends AbstractFilter
{
    protected array $filters = [
        'title' => TitleFilter::class
    ];
}
