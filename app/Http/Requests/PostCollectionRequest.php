<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCollectionRequest extends FormRequest
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
            'filter.body' => 'filled',
            'filter.title' => 'filled',
        ];
    }

    public function attributes(): array
    {
        return [
            'filter.userId' => 'filter user id',
            'filter.body' => 'filter body',
            'filter.title' => 'filter title',
        ];
    }

}
