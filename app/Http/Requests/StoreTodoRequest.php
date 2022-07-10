<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'title' => htmlspecialchars($this->title),
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
            'due_on' => 'required|date|date_format:Y-m-d',
            'status' => 'required|in:pending,completed',
        ];
    }
}
