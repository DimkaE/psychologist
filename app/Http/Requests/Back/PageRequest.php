<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        return [
            'url' => ['required','string','max:255', Rule::unique('pages')->ignore($request->get('id'))],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
