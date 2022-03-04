<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends BackController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('back.pages.index', [
            'items' => Page::get(),
            'request' => $request,
            'fields' => config('items.page_fields')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Page $page
     */
    public function edit(Page $page)
    {
        return view('back.pages.edit', [
            'item' => $page,
            'fields' => config('items.page_fields')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->fill($request->validated())->save();
        return response()->success();
    }
}
