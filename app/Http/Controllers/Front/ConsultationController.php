<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\Front\ConsultationRequest;
use App\Http\Requests\Front\ConsultationUpdateRequest;
use App\Jobs\ConsultationCancelledJob;
use App\Jobs\ConsultationCreatedJob;
use App\Jobs\ConsultationUpdatedJob;
use App\Jobs\MessageSendJob;
use App\Jobs\PsychologistRegisteredJob;
use App\Models\Consultation;
use App\Models\Payment;
use App\Models\User;
use App\Services\Front\ConsultationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class ConsultationController extends FrontController
{
    private ConsultationService $consultationService;

    public function __construct()
    {
        $this->consultationService = new ConsultationService;
    }

    public function availableDates(Request $request): \Illuminate\Http\JsonResponse
    {
        $psychologist = User::psychologist()->find($request->get('id'));
        abort_if(!$psychologist, 404);
        return response()->json(
            $this->consultationService->availableDates($psychologist)
        );
    }

    public function availableTimes(Request $request): \Illuminate\Http\JsonResponse
    {
        $psychologist = User::psychologist()->find($request->get('id'));
        abort_if(!$psychologist, 404);
        return response()->json(
            $this->consultationService->availableTimes(
                $psychologist,
                new Carbon($request->get('date', ''))
            )
        );
    }

    public function price(Request $request): JsonResponse
    {
        return response()->json(number_format($this->consultationService->price($request->get('promocode', '')), 0, '.', ''));
    }

    public function store(ConsultationRequest $request)
    {
        $consultation = Consultation::where([
            ['psychologist_id', $request->get('psychologist_id')],
            ['datetime', $request->get('datetime')],
        ])
            ->active()
            ->first();
        if ($consultation && $consultation->client_id != auth()->id())
            return response()->error('Это время уже занято. Попробуйте выбрать другое');
        if (!$consultation)
            $consultation = new Consultation;
        $consultation->fill($request->validated());
        $consultation->status = 1;
        $consultation->client_id = auth()->id();
        $consultation->save();

        ConsultationCreatedJob::dispatchAfterResponse($consultation);

        if ($this->consultationService->addPayment($consultation))
            return response()->redirect(route('account.index'));

        return response()->redirect(route('payments.create', [
            'consultation_id' => $consultation->id,
            'promocode' => $request->get('promocode')
        ]));
    }

    public function list(): JsonResponse
    {
        return response()->json([
            'records' => $this->consultationService->getRecords(),
            'recordsFinished' => $this->consultationService->getRecords(true)
        ]);
    }

    public function cancel(Request $request)
    {
        $consultation = Consultation::findOrFail($request->get('consultation_id'));
        abort_if(Gate::denies('edit_consultation', $consultation), 403);
        if (auth()->id() == $consultation->client_id) {
            $consultation->status = Consultation::STATUS_CANCELLED_BY_CLIENT;
        }
        if (auth()->id() == $consultation->psychologist_id) {
            $consultation->status = Consultation::STATUS_CANCELLED_BY_PSYCHOLOGIST;
        }
        $payment = Payment::where('consultation_id', $consultation->id)->first();
        if ($payment) {
            $payment->consultation_id = null;
            $payment->save();
        }
        $consultation->save();
        ConsultationCancelledJob::dispatchAfterResponse($consultation);

        return response()->success();
    }

    public function update(ConsultationUpdateRequest $request, Consultation $consultation)
    {
        $consultation->fill($request->validated());
        $consultation->save();
        ConsultationUpdatedJob::dispatchAfterResponse($consultation);

        return response()->success();
    }

    public function clean(Request $request)
    {
        if ($request->get('key') == config('app.cleaner_key')) {
            Payment::where([
                ['status', Payment::STATUS_NEW],
                ['created_at', '<', new Carbon('-10 minutes')]
            ])->delete();
            Consultation::where([
                ['status', Consultation::STATUS_NEW],
                ['created_at', '<', new Carbon('-65 minutes')]
            ])->delete();
        }
    }
}
