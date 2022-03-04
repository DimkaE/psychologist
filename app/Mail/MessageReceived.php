<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class MessageReceived extends Notification
{
    use Queueable, SerializesModels;

    protected string $title;
    protected string $message;
    protected User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $title, string $message, User $user)
    {
        $this->title = $title;
        $this->message = $message;
        $this->user = $user;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $breaks = array("<br />","<br>","<br/>");
        return (new MailMessage)
            ->subject('Новое сообщение на сайте ' . config('app.name'))
            ->greeting('Здравствуйте, ' . $this->user->name . '!')
            ->line('Вы получили новое сообщение на сайте ' . config('app.name'))
            ->line('Заголовок: ' . $this->title)
            ->line('Сообщение: ' . strip_tags(str_ireplace($breaks, "\r\n", $this->message)))
            ->action('Посмотреть все сообщения', route('account.messages'));
    }

}
