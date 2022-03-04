<?php

namespace App\Jobs;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConsultationUpdatedJob implements ShouldQueue
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
        MessageSendJob::dispatchAfterResponse(
            "Клиент перенес консультацию",
            "Перенесена консультация № " . $this->consultation->id . " (новое время начала: " . $this->consultation->datetime->format('d.m.Y, H:i') . ").<br>"
            . "Часовой пояс -" . config('app.timezone_txt') . ".<br>"
            . "Посмотреть подробности можно в разделе <a href='" . route('account.index') . "'>записи на прием</a>",
            $this->consultation->psychologist_id
        );

        SmsSendJob::dispatchAfterResponse('Время консультации изменено', $this->consultation->psychologist_id);

        MessageSendJob::dispatchAfterResponse(
            "Вы перенесли консультацию",
            "Перенесена консультация № " . $this->consultation->id . " (новое время начала: " . $this->consultation->datetime->format('d.m.Y, H:i') . ").<br>"
            . "Часовой пояс -" . config('app.timezone_txt') . ".<br>"
            . "Посмотреть подробности можно в разделе <a href='" . route('account.index') . "'>записи на прием</a>",
            $this->consultation->client_id
        );
    }
}
