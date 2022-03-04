<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class DirectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
