<?php

namespace App\Jobs;

use App\Mail\MessageReceived;
use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MessageSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $title;
    protected string $message;
    protected User $user;

    public function __construct(string $title, string $message, int $user_id)
    {
        $this->title = $title;
        $this->message = $message;
        $this->user = User::findOrFail($user_id);
    }

    public function handle()
    {
        Message::create([
            'title' => $this->title,
            'content' => $this->message,
            'user_id' => $this->user->id,
        ]);
        $this->user->notify(new MessageReceived($this->title, $this->message, $this->user));
    }
}
