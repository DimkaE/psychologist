<?php

namespace App\Http\Controllers\Front;

use App\Models\Direction;
use App\Models\PsychologistDirection;
use App\Models\User;
use App\Services\Front\SearchService;
use Illuminate\Http\Request;

class SearchController extends FrontController
{

    private SearchService $searchService;

    public function __construct()
    {
        $this->searchService = new SearchService;
    }

    public function index()
    {
        $users = User::inRandomOrder()->psychologist()->take(4)->get();
        $avatars = [];
        foreach ($users as $user) {
            $avatars[] = $user->ava52;
        }
        return view('front.search',
            [
                'directions' => Direction::get(),
                'total' => User::psychologist()->count(),
                'avatars' => $avatars
            ]);
    }

    public function filtered(Request $request) :\Illuminate\Http\JsonResponse
    {
        $was_filtered = false;
        $ids = [];
        if ($request->get('directions')) {
            $ids = PsychologistDirection::whereIn('direction_id', $request->get('directions'))
                ->pluck('user_id')
                ->toArray();
            $was_filtered = true;
        }
        if ($request->get('gender')) {
            $temp_ids = User::where('gender', '=', $request->get('gender'))
                ->pluck('id')
                ->toArray();
            $ids = $was_filtered
                ? array_uintersect($ids, $temp_ids, 'strcasecmp')
                : $temp_ids;
            $was_filtered = true;
        }
        if (!$request->get('any_age')
            && ($request->get('age_min') || $request->get('age_max'))) {
            $temp_ids = $this->searchService->filterByAge($request->get('age_min'), $request->get('age_max'));
            $ids = $was_filtered
                ? array_uintersect($ids, $temp_ids, 'strcasecmp')
                : $temp_ids;
            $was_filtered = true;
        }
        if ($request->get('date')) {
            $temp_ids = $this->searchService->filterByDate($request->get('date'));
            $ids = $was_filtered
                ? array_uintersect($ids, $temp_ids, 'strcasecmp')
                : $temp_ids;
            $was_filtered = true;
        }

        if ($request->get('times')) {
            $temp_ids = $this->searchService->filterByTimes($request->get('times'));
            $ids = $was_filtered
                ? array_uintersect($ids, $temp_ids, 'strcasecmp')
                : $temp_ids;
            $was_filtered = true;
        }

        $query = User::visible()
            ->psychologist();
        if ($was_filtered)
            $query->whereIn('id', $ids);
        $users = $query->limit(4)->get();

        return response()->json($users);
    }
}
