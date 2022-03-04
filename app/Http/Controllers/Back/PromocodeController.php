<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\PromocodeRequest;
use App\Models\Promocode;
use App\Services\Back\PromocodeService;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{

    private PromocodeService $promocodeService;

    public function __construct()
    {
        $this->promocodeService = new PromocodeService;
    }

    public function index(Request $request)
    {
        $items = Promocode::where($this->promocodeService->filter($request))
            ->orderBy(
                $request->get('sort_col') ?: 'created_at',
                $request->get('sort_dir') ?: 'desc'
            )
            ->paginate(50);
        return view('back.promocodes.index', [
            'items' => $items,
            'request' => $request,
            'fields' => config('items.promocode_fields'),
        ]);
    }

    public function create()
    {
        return view('back.promocodes.edit', [
            'item' => null,
            'fields' => config('items.promocode_fields'),
        ]);
    }

    public function store(PromocodeRequest $request)
    {
        Promocode::create($request->validated());
        return response()->redirect(route('back.promocodes.index'));
    }


    public function edit(Promocode $promocode)
    {
        return view('back.promocodes.edit', [
            'item' => $promocode,
            'fields' => config('items.promocode_fields'),
        ]);
    }

    public function update(PromocodeRequest $request, Promocode $promocode)
    {
        $promocode->fill($request->validated())->save();
        return response()->redirect(route('back.promocodes.index'));
    }

    public function destroy(Promocode $promocode)
    {
        $promocode->delete();
        return redirect(route('back.promocodes.index'));
    }
}
