<?php

namespace App\Http\Traits\Back;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait ImageTrait
{
    public function updateImages(Request $request, Model $item, string $collection)
    {
        if ($request->image) {
            $item->clearMediaCollection($collection);
            $item->addMedia($request->image)
                ->toMediaCollection($collection);
        }
        if ($request->image_delete) {
            $item->clearMediaCollection($collection);
        }

    }
}
