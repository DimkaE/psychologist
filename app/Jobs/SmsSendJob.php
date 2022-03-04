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
use Illuminate\Support\Facades\Log;

class SmsSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $message;
    protected User $user;

    public function __construct(string $message, int $user_id)
    {
        $this->message = $message;
        $this->user = User::findOrFail($user_id);
    }

    public function handle()
    {
        if ($this->user->phone) {
            $this->sendSms($this->user->phone, $this->message);
        }
    }

    function sendSms($phone, $text)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $host = config('app.sms_host');
        $login = config('app.sms_login');
        $password = config('app.sms_password');
        $sender = false;
        $wapurl = false;
        $fp = fsockopen($host, 80, $errno, $errstr);
        if (!$fp) {
            return "errno: $errno \nerrstr: $errstr\n";
        }
        fwrite($fp, "GET /messages/v2/send/" .
            "?phone=" . rawurlencode($phone) .
            "&text=" . rawurlencode($text) .
            ($sender ? "&sender=" . rawurlencode($sender) : "") .
            ($wapurl ? "&wapurl=" . rawurlencode($wapurl) : "") .
            "  HTTP/1.0\n");
        fwrite($fp, "Host: " . $host . "\r\n");
        if ($login != "") {
            fwrite($fp, "Authorization: Basic " .
                base64_encode($login . ":" . $password) . "\n");
        }
        fwrite($fp, "\n");
        $response = "";
        while (!feof($fp)) {
            $response .= fread($fp, 1);
        }
        fclose($fp);
        list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
        Log::log('info', $responseBody . '. phone: ' . $phone . '. message: ' . $text);
    }
}
