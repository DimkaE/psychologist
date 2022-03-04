<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        $password =  ['required', Rules\Password::defaults()];
        if($request->get('id'))
            $password[0] = 'nullable';
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->get('id'))],
            'password' => $password,
            'phone' => ['nullable', Rule::unique('users')->ignore($request->get('id'))],
            'second_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'experience' => 'nullable|numeric|min:0',
            'experience_online' => 'nullable|numeric|min:0',
            'clients' => 'nullable|numeric|min:0',
            'psychotherapy' => 'nullable|boolean',
            'supervision' => 'nullable|boolean',
            'supervisor' => 'nullable|string|max:255',
            'longest_consultation' => 'nullable|string|max:255',
            'about' => 'nullable|string|max:2000',
            'other_work' => 'nullable|string|max:2000',
            'skype' => 'nullable|string|max:255',
            'discord' => 'nullable|string|max:255',
            'hangouts' => 'nullable|string|max:255',
            'enabled' => 'nullable|boolean',
            'published' => 'nullable|boolean',
            'role' => ['required', Rule::in(collect_ids(config('app.user_roles')))],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
