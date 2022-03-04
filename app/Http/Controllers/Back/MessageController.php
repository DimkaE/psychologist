<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\MessageRequest;
use App\Models\Message;
use App\Models\User;
use App\Services\Back\MessageService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends BackController
{

    private MessageService $messageService;

    public function __construct()
    {
        $this->messageService = new MessageService;
    }

    public function index(Request $request)
    {
        $items = Message::where($this->messageService->filter($request))
            ->orderBy(
                $request->get('sort_col') ?: 'created_at',
                $request->get('sort_dir') ?: 'desc'
            )
            ->joinUsers()
            ->paginate(50);
        return view('back.messages.index', [
            'items' => $items,
            'request' => $request,
            'fields' => config('items.message_fields'),
        ]);
    }

    public function create()
    {
        return view('back.messages.edit', [
            'item' => null,
            'fields' => config('items.message_fields'),
        ]);
    }

    public function store(MessageRequest $request)
    {
        Message::create($request->validated());
        return response()->redirect(route('back.messages.index'));
    }

    public function clear()
    {
        Message::where('updated_at', '<', new Carbon('-6 months'))->delete();
        return redirect(route('back.messages.index'));
    }
}
