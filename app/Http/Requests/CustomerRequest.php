<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class CustomerRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->get('id'))],
            'password' => ['nullable', Rules\Password::defaults()],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
