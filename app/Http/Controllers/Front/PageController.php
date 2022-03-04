<?php

namespace App\Http\Controllers\Front;

use App\Models\Direction;
use App\Models\Page;
use App\Models\Question;
use App\Models\Review;
use App\Models\User;

class PageController extends FrontController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dir_tot = Direction::count();
        $dir_half = floor($dir_tot / 2);
        $users = User::inRandomOrder()->psychologist()->take(20)->get();
        $avatars = [];
        foreach ($users as $user) {
            $avatars[] = $user->ava193;
        }
        $page = Page::where('url', '=', '/')->first();
        if ($page) {
            $title = $page->meta_title;
            $description = $page->meta_title;
        }

        return view('front.index', [
            'directions' => Direction::orderBy('name')
                ->take($dir_half)
                ->get(),
            'directions2' => Direction::orderBy('name')
                ->skip($dir_half)
                ->take($dir_tot - $dir_half)
                ->get(),
            'avatars' => $avatars,
            'title' => $title ?? '',
            'description' => $description ?? '',
            'questions' => Question::where('type', Question::TYPE_CLIENT)->get(),
            'reviews' => Review::where('type', Review::TYPE_CLIENT)
                ->orderBy('sort_order')->get(),
        ]);
    }

    public function work()
    {
        $page = Page::where('url', '=', '/work')->first();
        if ($page) {
            $title = $page->meta_title;
            $description = $page->meta_title;
        }
        return view('front.work', [
            'questions' => Question::where('type', Question::TYPE_PSYCHOLOGIST)->get(),
            'reviews' => Review::where('type', Review::TYPE_PSYCHOLOGIST)
                ->orderBy('sort_order')->get(),
            'title' => $title ?? '',
            'description' => $description ?? '',
        ]);
    }
}
