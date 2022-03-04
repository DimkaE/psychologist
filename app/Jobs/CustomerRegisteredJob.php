<?php

namespace App\Jobs;

use App\Mail\CustomerRegistered;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CustomerRegisteredJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function handle()
    {
        auth()->user()->notify(new CustomerRegistered($this->password));
    }
}
