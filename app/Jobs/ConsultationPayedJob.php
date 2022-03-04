<?php

namespace App\Jobs;

use App\Models\Consultation;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConsultationPayedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Consultation $consultation;
    private Payment $payment;

    public function __construct(Consultation $consultation, Payment $payment)
    {
        $this->consultation = $consultation;
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $text = "Вы оплатили консультацию №" . $this->payment->consultation_id . ".<br>"
            . "Специалист: " . $this->consultation->psychologist->name . " " . $this->consultation->psychologist->second_name . " " . $this->consultation->psychologist->last_name . ".<br>"
            . "Связаться со специалистом можно с помощью:<br>";
        if ($this->consultation->psychologist->skype)
            $text .= "Skype: " . $this->consultation->psychologist->skype . "<br>";
        if ($this->consultation->psychologist->discord)
            $text .= "Discord: " . $this->consultation->psychologist->discord . "<br>";
        if ($this->consultation->psychologist->hangouts)
            $text .= "Hangouts: " . $this->consultation->psychologist->hangouts . "<br>";
        $text .= "Номер консультации:" . $this->payment->consultation_id . ".<br>"
            . "Перед консультацией проверьте оборудование (камеру, микрофон, динамик) и напишите сообщение психологу за 1-2 часа до начала сеанса<br>"
            . "Посмотреть подробности можно в разделе <a href='" . route('account.index') . "'>записи на прием</a>";

        MessageSendJob::dispatchAfterResponse(
            "Консультация оплачена",
            $text,
            $this->payment->user_id
        );

        SmsSendJob::dispatchAfterResponse('Вы оплатили консультацию', $this->consultation->client_id);

        MessageSendJob::dispatchAfterResponse(
            "Консультация оплачена",
            "Начало: " . $this->consultation->datetime->format('d.m.Y, H:i') . ".<br>"
            . "Часовой пояс -" . config('app.timezone_txt') . ".<br>"
            . "Посмотреть подробности можно в разделе <a href='" . route('account.index') . "'>записи на прием</a>",
            $this->consultation->psychologist_id
        );

        SmsSendJob::dispatchAfterResponse('Вам назначена консультация', $this->consultation->psychologist_id);
    }
}
