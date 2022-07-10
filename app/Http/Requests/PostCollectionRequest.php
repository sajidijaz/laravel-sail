<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCollectionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'page' => 'filled|integer|min:1',
            'limit' => 'filled|integer|between:1,100',
            'filter' => [
                'nullable',
                'array',
            ],
            'filter.user_id' => 'filled|min:1',
            'filter.body' => 'filled',
            'filter.title' => 'filled',
        ];
    }
}
