<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter
{
    protected array $filters = [];
    protected string $path;

    public function __construct(protected Request $request) {}

    public function filter(Builder $builder): Builder
    {
        foreach($this->getFilters() as $filter => $value)
        {
            $this->resolveFilter($filter)->filter($builder, $value);
        }
        return $builder;
    }

    protected function getFilters(): array
    {
        $requestFilter = $this->request->only('filter');
        if(!empty($requestFilter['filter'])) {
            return array_intersect_key($requestFilter['filter'], $this->filters);
        }
        return [];
    }

    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter];
    }
}
