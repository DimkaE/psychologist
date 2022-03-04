<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        return [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'intro' => 'required|string|max:5000',
            'text' => 'required|string|max:5000',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'url' => ['required', Rule::unique('articles')->ignore($request->get('id'))],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
