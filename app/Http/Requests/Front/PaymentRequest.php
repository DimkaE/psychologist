<?php

namespace App\Http\Requests\Front;

use App\Http\Traits\Front\ScheduleTrait;
use App\Models\Consultation;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{

    public function rules(Request $request): array
    {
        return [
            'consultation_id' => [
                'required',
                Rule::exists('consultations', 'id')->where(function ($query) use ($request) {
                    return $query->where([
                        ['client_id', auth()->id()],
                        ['status', Payment::STATUS_NEW],
                    ]);
                }),
            ],
            'number' => 'required|min:16|max:19',
            'date' => 'required|min:5|max:5',
            'name' => 'required|string|min:5',
            'cvc' => 'required|min:3|max:3',
        ];
    }

    public function messages(): array
    {
        return [
            'datetime.*' => 'Выбранные дата и время уже заняты. Обновите страницу, чтобы посмотреть актуальное расписание',
            'number.*' => 'Некорректно указан номер карты',
            'date.*' => 'Некорректно указано',
            'name.*' => 'Некорректно указано имя',
            'cvc.*' => 'Некорректно указано',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
