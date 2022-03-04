<?php

namespace App\Http\Controllers\Back;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends BackController
{
    public function dashboard()
    {
        $users = User::where([
            ['published', false],
            ['role', User::ROLE_PSYCHOLOGIST]
        ])->get();
        return view('back.dashboard', compact('users'));
    }

    public function edit()
    {
        $textarea = ['powered', 'policy'];
        $numbers = ['price', 'first_price', 'second_price'];
        $required = ['first_price', 'second_price', 'price', 'email'];
        $settings = Setting::get();
        return view('back.settings', compact('textarea', 'required', 'numbers', 'settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->get('settings') as $k => $setting) {
            Setting::where('key', $k)
                ->update(['value' => $setting]);
        }
        return response()->success();
    }
}
