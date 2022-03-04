<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConsultationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(collect_ids(config('app.consultation_statuses')))],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
