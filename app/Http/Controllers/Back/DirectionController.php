<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\DirectionRequest;
use App\Models\Direction;
use App\Services\Back\DirectionService;
use Illuminate\Http\Request;

class DirectionController extends BackController
{

    private $directionService;

   public function __construct()
   {
       $this->directionService = new DirectionService;
   }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Direction::where($this->directionService->filter($request))
            ->orderBy(
                $request->get('sort_col') ?: 'name',
                $request->get('sort_dir') ?: 'asc'
            )->paginate(50);
        return view('back.directions.index', [
            'items' => $items,
            'request' => $request,
            'fields' => config('items.direction_fields'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.directions.edit', [
            'item' => null,
            'fields' => config('items.direction_fields'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectionRequest $request)
    {
        Direction::create($request->validated());
        return response()->redirect(route('back.directions.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Direction  $direction
     */
    public function edit(Direction $direction)
    {
        return view('back.directions.edit', [
            'item' => $direction,
            'fields' => config('items.direction_fields'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function update(DirectionRequest $request, Direction $direction)
    {
        $direction->fill($request->validated())->save();
        return response()->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Direction $direction)
    {
        $direction->delete();
        return redirect(route('back.directions.index'));
    }
}
