<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PromocodeRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        return [
            'code' => ['required', 'string', Rule::unique('promocodes')->ignore($request->get('code'))],
            'type' => ['required', Rule::in(collect_ids(config('app.promocode_types')))],
            'value' => 'required|integer|min:1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
