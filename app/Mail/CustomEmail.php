<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $title;
    protected string $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $title, string $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    public function build()
    {
        return $this->view('emails.mail')
            ->subject($this->title . ' (' . config('app.name') . ')')
            ->with([
                'message1' => $this->message,
            ]);
    }
}
