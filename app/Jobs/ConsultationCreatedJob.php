<?php

namespace App\Jobs;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConsultationCreatedJob implements ShouldQueue
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
            "Вам назначена консультация",
            "Начало: " . $this->consultation->datetime->format('d.m.Y, H:i') . ".<br>"
            . "Часовой пояс -" . config('app.timezone_txt') . ".<br>"
            . "Посмотреть подробности можно в разделе <a href='" . route('account.index') . "'>записи на прием</a>",
            $this->consultation->psychologist_id
        );
        MessageSendJob::dispatchAfterResponse(
            "Вы назначили консультацию",
            "Время будет забронировано после оплаты.<br>"
            . "Начало: " . $this->consultation->datetime->format('d.m.Y, H:i') . ".<br>"
            . "Часовой пояс -" . config('app.timezone_txt') . ".<br>"
            . "Посмотреть подробности можно в разделе <a href='" . route('account.index') . "'>записи на прием</a>",
            $this->consultation->client_id
        );
    }
}
