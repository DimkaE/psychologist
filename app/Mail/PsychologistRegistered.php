<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class PsychologistRegistered extends Notification
{
    use Queueable, SerializesModels;

    protected string $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable) :MailMessage
    {
        return (new MailMessage)
            ->subject('Регистрация на сайте ' . config('app.name'))
            ->greeting('Здравствуйте, ' . auth()->user()->name . '!')
            ->line('Ваша заявка на сайте ' . config('app.name') . ' отправлена администратору')
            ->line('Посмотреть ее статус и можно в личном кабинете')
            ->line('Используйте для входа данные:')
            ->line('Логин: ' . auth()->user()->email)
            ->line('Пароль: ' . $this->password)
            ->action('Личный кабинет', route('account.index'));
    }

}
