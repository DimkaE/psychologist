<?php

namespace App\Http\Traits\Front;

use App\Models\Payment;
use App\Models\Promocode;
use App\Models\Setting;

trait PriceTrait
{
    public function price($promocode)
    {
        $consultation_payments = Payment::where([
            ['user_id', auth()->id()],
            ['status', Payment::STATUS_PAYED],
        ])->count();
        switch ($consultation_payments) {
            case 0:
                $key = 'first_price';
                break;
            case 1:
                $key = 'second_price';
                break;
            default:
                $key = 'price';

        }

        $price = Setting::where('key', '=', $key)->first()->value;
        if ($promocode) {
            $model_promocode = Promocode::where('code', $promocode)->first();
            if ($model_promocode) {
                if ($model_promocode->type == Promocode::TYPE_SUM) {
                    $price -= $model_promocode->value;
                }
                if ($model_promocode->type == Promocode::TYPE_PERCENT) {
                    $price *= (1 - $model_promocode->value / 100);
                }
            }
        }

        if (Payment::where([
            ['user_id', auth()->id()],
            ['consultation_id', null]
        ])->count())
            $price = 0;
        return $price;
    }
}
