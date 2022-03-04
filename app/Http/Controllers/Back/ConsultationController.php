<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\ConsultationRequest;
use App\Models\Consultation;
use App\Services\Back\ConsultationService;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    private ConsultationService $consultationService;

    public function __construct()
    {
        $this->consultationService = new ConsultationService;
    }

    public function index(Request $request)
    {
        $items = Consultation::where($this->consultationService->filter($request))
            ->orderBy(
                $request->get('sort_col') ?: 'id',
                $request->get('sort_dir') ?: 'desc'
            )
            ->leftJoin('users as clients', 'consultations.client_id', '=', 'clients.id')
            ->leftJoin('users as psychologists', 'consultations.psychologist_id', '=', 'psychologists.id')
            ->leftJoin('payments', 'consultations.id', '=', 'payments.consultation_id')
            ->select([
                'consultations.*',
                'psychologists.email as psychologist_email',
                'clients.email as client_email',
                'payments.sum as payment_sum',
            ])
            ->paginate(50);
        return view('back.consultations.index', [
            'items' => $items,
            'request' => $request,
            'fields' => config('items.consultation_fields'),
        ]);
    }

    public function show(Consultation $consultation)
    {
        return view('back.consultations.edit', [
            'item' => $consultation->load(['client', 'psychologist']),
            'fields' => config('items.consultation_fields'),
        ]);
    }

}
