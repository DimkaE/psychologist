<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\ReviewRequest;
use App\Models\Review;
use App\Services\Back\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends BackController
{
    private ReviewService $reviewService;

    public function __construct()
    {
        $this->reviewService = new ReviewService;
    }

    public function index(Request $request)
    {
        $items = Review::where($this->reviewService->filter($request))
            ->orderBy(
                $request->get('sort_col') ?: 'id',
                $request->get('sort_dir') ?: 'desc'
            )->paginate(50);
        return view('back.reviews.index', [
            'items' => $items,
            'request' => $request,
            'fields' => config('items.review_fields'),
        ]);
    }

    public function create()
    {
        return view('back.reviews.edit', [
            'item' => null,
            'fields' => config('items.review_fields'),
        ]);
    }

    public function store(ReviewRequest $request)
    {
        $review = new Review;
        $review->fill($request->validated());
        $review->save();
        $this->reviewService->updateImages($request, $review, 'image');
        return response()->redirect(route('back.reviews.edit', ['review' => $review->id]));
    }

    public function edit(Review $review)
    {
        return view('back.reviews.edit', [
            'item' => $review,
            'fields' => config('items.review_fields'),
        ]);
    }

    public function update(ReviewRequest $request, Review $review)
    {
        $review->fill($request->validated());
        $review->save();
        $this->reviewService->updateImages($request, $review, 'image');
        return response()->success();
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect(route('back.reviews.index'));
    }
}
