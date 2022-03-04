<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\PaymentRequest;
use App\Models\Consultation;
use App\Models\Payment;
use App\Services\Back\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends BackController
{
    private PaymentService $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService;
    }

    public function index(Request $request)
    {
        $items = Payment::where($this->paymentService->filter($request))
            ->orderBy(
                $request->get('sort_col') ?: 'id',
                $request->get('sort_dir') ?: 'desc'
            )
            ->leftJoin('users', 'payments.user_id', '=', 'users.id')
            ->leftJoin('consultations', 'consultations.id', '=', 'payments.consultation_id')
            ->select([
                'payments.*',
                'consultations.datetime as consultation_datetime',
                'users.email as user_email',
            ])
            ->paginate(50);
        return view('back.payments.index', [
            'items' => $items,
            'request' => $request,
            'fields' => config('items.payment_fields'),
        ]);
    }

    public function show(Payment $payment)
    {
        return view('back.payments.edit', [
            'item' => $payment->load(['user', 'consultation']),
            'fields' => config('items.payment_fields'),
        ]);
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $payment->fill($request->validated())->save();
        return response()->success();
    }

    public function add(Request $request)
    {
        $user_id = $request->get('user_id');
        $quantity = $request->get('quantity');
        if ($user_id && $quantity) {
            for ($i = 0; $i < $quantity; $i++)
                Payment::create([
                    'user_id' => $user_id,
                    'status' => Payment::STATUS_PAYED,
                    'sum' => 0,
                    'final_sum' => 0,
                    'system' => Payment::PAY_SYSTEM_ADMIN,
                ]);
        }
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $payment_id = $request->get('payment_id');
        $payment = Payment::FindOrFail($payment_id);
        if ($payment->system == Payment::PAY_SYSTEM_ADMIN && !$payment->consultation_id)
            $payment->delete();
        return redirect()->back();
    }
}
