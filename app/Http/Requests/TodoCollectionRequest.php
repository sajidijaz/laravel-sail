<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoCollectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => 'filled|integer|min:1',
            'limit' => 'filled|integer|between:1,100',
            'filter' => [
                'nullable',
                'array',
            ],
            'filter.userId' => 'filled|integer|min:1',
            'filter.title' => 'filled',
            'filter.status' => 'filled|in:pending,completed',
            'filter.dueOn' => 'filled|date|date_format:Y-m-d',
        ];
    }

    public function attributes(): array
    {
        return [
            'filter.userId' => 'filter user id',
            'filter.dueOn' => 'filter due on',
            'filter.title' => 'filter title',
            'filter.status' => 'filter status',
        ];
    }
}
