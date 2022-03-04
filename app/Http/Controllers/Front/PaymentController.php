<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\PaymentRequest;
use App\Http\Traits\Front\PriceTrait;
use App\Jobs\ConsultationPayedJob;
use App\Jobs\MessageSendJob;
use App\Models\Consultation;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    use PriceTrait;

    public function create(Request $request)
    {
        return view('front.payment', [
            'consultation' => Consultation::where([
                ['id', $request->get('consultation_id')],
                ['client_id', auth()->id()],
                ['status', Payment::STATUS_NEW],
            ])
                ->with('psychologist')
                ->firstOrFail(),
            'price' => $this->price($request->get('promocode', ''))
        ]);
    }

    public function store(PaymentRequest $request)
    {
        try {
            $stripe = new StripeClient(config('app.stripe_secret'));
            $card_to = explode('/', $request->get('date'));
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => str_replace(' ', '', $request->get('number')),
                    'exp_month' => $card_to[0],
                    'exp_year' => '20' . $card_to[1],
                    'cvc' => $request->get('cvc'),
                ],
            ]);
            if ($token->id) {
                $consultation = Consultation::find($request->get('consultation_id'));
                $comment = '';
                if ($request->get('promocode'))
                    $comment = 'Скидка по промокоду ' . $request->get('promocode');
                $payment = $consultation->payment()->create([
                    'user_id' => auth()->id(),
                    'status' => Payment::STATUS_NEW,
                    'sum' => $this->price(''),
                    'final_sum' => $this->price($request->get('promocode')),
                    'system' => Payment::PAY_SYSTEM_STRIPE,
                    'comment' => $comment
                ]);

                $stripe_payment = $stripe->charges->create([
                    'amount' => $payment->final_sum * 100,
                    'currency' => 'bgn',
                    'source' => $token->id,
                    'description' => 'Consultation ID' . $consultation->id . ', payment ID' . $payment->id,
                ]);


                if ($stripe_payment->amount == $payment->final_sum * 100
                    && $stripe_payment->status == "succeeded") {
                    $payment->ext_id = $stripe_payment->id;
                    $payment->save();
                    $this->confirm($payment);
                }
            }
        } catch (\Stripe\Exception\CardException $e) {
            return response()->error('Произошла ошибка1: ' . $e->getError()->message);
        } catch (\Exception $e) {
            return response()->error('Произошла ошибка. Попробуйте повторить попытку позже.');
        }

        return response()->redirect(route('account.index'));
    }

    public function confirm(Payment $payment)
    {
        if ($payment->status == Payment::STATUS_NEW) {
            $payment->status = Payment::STATUS_PAYED;
            $payment->pay_date = new Carbon();
            $payment->save();
            if ($payment->consultation_id) {
                $consultation = Consultation::findOrFail($payment->consultation_id);
                $consultation->status = Consultation::STATUS_PAYED;
                $consultation->save();
                ConsultationPayedJob::dispatchAfterResponse($consultation, $payment);
            }
        }
        return redirect(route('account.index'));
    }

    public function unused()
    {
        return response()->json(Payment::where([
            ['user_id', auth()->id()],
            ['consultation_id', null],
            ['status', Payment::STATUS_PAYED]
        ])->count());
    }
}
