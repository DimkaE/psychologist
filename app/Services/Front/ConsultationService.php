<?php

namespace App\Services\Front;

use App\Http\Traits\Front\PriceTrait;
use App\Http\Traits\Front\ScheduleTrait;
use App\Models\Consultation;
use App\Models\Payment;

class ConsultationService
{
    use ScheduleTrait, PriceTrait;

    public function addPayment(Consultation $consultation)
    {
        //если есть отмененный сеанс
        $payment = Payment::where([
            ['user_id', auth()->id()],
            ['consultation_id', null]
        ])->first();
        if (!$payment)
            return false;
        $payment->consultation_id = $consultation->id;
        $payment->save();
        $consultation = Consultation::findOrFail($payment->consultation_id);
        $consultation->status = Consultation::STATUS_PAYED;
        $consultation->save();
        return true;
    }

}
