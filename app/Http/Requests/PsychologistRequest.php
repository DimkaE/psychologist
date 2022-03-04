<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class PsychologistRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        $psychologist_rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->get('id'))],
            'phone' => ['required', Rule::unique('users')->ignore($request->get('id'))],
            'second_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'experience' => 'required|numeric|min:0',
            'about' => 'required|string|max:2000',
            'skype' => 'nullable|string|max:255',
            'discord' => 'nullable|string|max:255',
            'hangouts' => 'nullable|string|max:255',
            'directions' => 'required',
            'photo' => 'required',
            'gender' => 'required|string',
            'educations' => 'required',
            'educations.*' => 'required|string|min:10|max:255',
            'educations_additional.*' => 'required|string|min:10|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_account' => 'nullable|string|max:19|min:16',
            'bank_holder' => 'nullable|string|max:255',
            'bank_date' => 'nullable|string|max:5|min:5',
        ];
        if (auth()->check()) {
            $psychologist_rules['photo'] = 'nullable';
            $psychologist_rules['password'] = ['nullable', Rules\Password::defaults()];
        } else {
            $supervisor = 'nullable|string|max:255';
            if ($request->get('supervision'))
                $supervisor = 'required|string|max:255';
            $psychologist_rules['supervisor'] = $supervisor;
            $psychologist_rules['supervision'] = 'required|boolean';
            $psychologist_rules['psychotherapy'] = 'required|boolean';
            $psychologist_rules['clients'] = 'required|numeric|min:0';
            $psychologist_rules['experience_online'] = 'required|numeric|min:0';
            $psychologist_rules['longest_consultation'] = 'required|string|max:255';
            $psychologist_rules['other_work'] = 'required|string|max:2000';
            $psychologist_rules['diplomas'] = 'required';

        }
        return $psychologist_rules;
    }

    public function messages()
    {
        return [
            'educations.*.required' => 'Заполните поле или удалите строку',
            'educations.*.min' => 'Не немее 10 символов',
            'educations.*.max' => 'Не более 255 символов',
            'gender.*' => 'Укажите пол',
            'educations_additional.*.required' => 'Заполните поле или удалите строку',
            'educations_additional.*.min' => 'Не немее 10 символов',
            'educations_additional.*.*.max' => 'Не более 255 символов',
            'supervision.required' => 'Выберите вариант',
            'psychotherapy.required' => 'Выберите вариант',
            'directions.required' => 'Выберите хотя бы одно направление',
        ];
    }

    public function authorize(Request $request): bool
    {
        if (!auth()->check())
            return true;

        return $request->get('id') == auth()->id();
    }
}
