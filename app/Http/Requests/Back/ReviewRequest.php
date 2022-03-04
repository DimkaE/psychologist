<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'text' => 'required|string|max:5000',
            'sort_order' => 'nullable|integer',
            'type' => ['required', Rule::in(collect_ids(config('app.review_types')))],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
