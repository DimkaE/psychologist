<?php

namespace App\Http\Controllers\Front;

use App\Mail\CustomEmail;
use App\Models\Direction;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AccountController extends FrontController
{
    public function index()
    {
        if (auth()->user()->role == User::ROLE_CUSTOMER)
            return view('front.account.client.index');

        return view('front.account.psychologist.index');
    }

    public function data()
    {
        if (auth()->user()->role == User::ROLE_CUSTOMER)
            return view('front.account.client.data', [
                'user' => auth()->user(),
            ]);
        return view('front.account.psychologist.data', [
            'user' => auth()->user()->load(['periodsRel']),
            'directions' => Direction::orderBy('name')->get(),
        ]);
    }

    public function messages()
    {
        $messages_read = auth()->user()
            ->messagesRel()
            ->orderBy('created_at', 'desc')
            ->read()
            ->get();
        $messages_unread = auth()->user()
            ->messagesRel()
            ->orderBy('created_at', 'desc')
            ->unread()
            ->get();
        foreach ($messages_unread as $message) {
            $message->read = true;
            $message->save();
        }
        return view('front.account.messages', compact(['messages_read', 'messages_unread']));
    }

    public function sendMessage(Request $request)
    {
        if ($request->get('message')) {
            $text = 'Вы получили новый вопрос с сайта:<br>' . $request->get('message')
            . 'Отправитель: ' . auth()->user()->email;
            Mail::to(Setting::where('key', 'email')->first()->value)
                ->send(new CustomEmail('Новый вопрос с сайта', $text));
        }
    }


}
