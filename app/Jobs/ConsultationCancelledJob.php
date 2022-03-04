<?php

namespace App\Jobs;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConsultationCancelledJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Consultation $consultation;

    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->consultation->status = Consultation::STATUS_CANCELLED_BY_CLIENT) {
            $text_psychologist = 'Клиент отменил консультацию';
            $text_client = 'Вы отменили консультацию';
        }
        if ($this->consultation->status = Consultation::STATUS_CANCELLED_BY_PSYCHOLOGIST) {
            $text_psychologist = 'Вы отменили консультацию';
            $text_client = 'Специалист отменил консультацию';
        }
        if (isset($text_psychologist) && isset($text_client)) {
            MessageSendJob::dispatchAfterResponse(
                $text_psychologist,
                "Отменена консультация № " . $this->consultation->id . " (время начала: " . $this->consultation->datetime->format('d.m.Y, H:i') . ").<br>"
                . "Часовой пояс -" . config('app.timezone_txt') . ".<br>"
                . "Посмотреть подробности можно в разделе <a href='" . route('account.index') . "'>записи на прием</a>",
                $this->consultation->psychologist_id
            );


            MessageSendJob::dispatchAfterResponse(
                $text_client,
                "Отменена консультация № " . $this->consultation->id . " (время начала: " . $this->consultation->datetime->format('d.m.Y, H:i') . ").<br>"
                . "Часовой пояс -" . config('app.timezone_txt') . ".<br>"
                . "Посмотреть подробности можно в разделе <a href='" . route('account.index') . "'>записи на прием</a>",
                $this->consultation->client_id
            );

            if ($this->consultation->status = Consultation::STATUS_CANCELLED_BY_CLIENT) {
                SmsSendJob::dispatchAfterResponse('Клиент отменил консультацию', $this->consultation->psychologist_id);
            } else {
                SmsSendJob::dispatchAfterResponse('Психолог отменил консультацию', $this->consultation->client_id);
            }
        }
    }
}
