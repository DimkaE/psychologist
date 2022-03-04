<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:5000',
            'type' => ['required', Rule::in(collect_ids(config('app.review_types')))],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
