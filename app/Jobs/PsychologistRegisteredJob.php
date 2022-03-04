<?php

namespace App\Jobs;

use App\Mail\PsychologistRegistered;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PsychologistRegisteredJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function handle()
    {
        auth()->user()->notify(new PsychologistRegistered($this->password));
    }
}
