<?php

namespace App\Http\Requests\Front;

use App\Http\Traits\Front\ScheduleTrait;
use App\Models\Consultation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ConsultationUpdateRequest extends FormRequest
{
    use ScheduleTrait;

    public function rules(Request $request): array
    {
        $consultation = Consultation::find($request->get('id'));
        $psychologist = User::findOrFail($consultation->psychologist_id);

        return [
            'datetime' => ['required', 'date', Rule::in($this->availableDateTimes($psychologist))],
        ];
    }

    public function messages(): array
    {
        return [
            'datetime.*' => 'Выбранные дата и время уже заняты. Обновите страницу, чтобы посмотреть актуальное расписание'
        ];
    }

    public function authorize(Request $request): bool
    {
        $consultation = Consultation::find($request->get('id'));
        if (!$consultation)
            return false;
        if (new Carbon($consultation->datetime) < new Carbon('+12 hours'))
            return false;
        return Gate::allows('edit_consultation', $consultation);
    }
}
