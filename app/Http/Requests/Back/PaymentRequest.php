<?php

namespace App\Http\Requests\Back;

use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{

    public function rules(Request $request): array
    {
        $return = [
            'pay_status' => ['required', Rule::in(collect_ids(config('app.payment_pay_statuses')))],
            'pay_out_sum' => ['nullable', 'integer', 'min:1']
        ];
        if ($request->get('pay_status') == Payment::PAY_STATUS_PAYED)
            $return['pay_out_sum'][0] = 'required';
        return $return;
    }

    public function authorize(): bool
    {
        return true;
    }
}
