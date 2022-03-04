<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:2000',
            'user_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'user_id.*' => 'Нужно выбрать получателя из выпадающего списка!'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
