<?php

namespace App\Http\Requests\Front;

use App\Http\Traits\Front\ScheduleTrait;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConsultationRequest extends FormRequest
{
    use ScheduleTrait;

    public function rules(Request $request): array
    {
        $psychologist = User::findOrFail($request->get('psychologist_id'));

        return [
            'psychologist_id' => [
                'required',
                Rule::exists('users', 'id')->where(function ($query) use ($request) {
                    return $query->where([
                        ['role', User::ROLE_PSYCHOLOGIST]
                    ]);
                }),
            ],
            'datetime' => ['required', 'date', Rule::in($this->availableDateTimes($psychologist))],
        ];
    }

    public function messages(): array
    {
        return [
            'datetime.*' => 'Выбранные дата и время уже заняты. Обновите страницу, чтобы посмотреть актуальное расписание',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
