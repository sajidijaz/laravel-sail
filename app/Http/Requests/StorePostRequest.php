<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'title' => htmlspecialchars($this->title),
                'body' => htmlspecialchars($this->body),
            ]
        );
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|min:1',
            'title' => 'required|max:255',
            'body' => 'required',
        ];
    }
}
