<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsappService
{
    public function send(string $phone, string $message): bool
    {
        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN')
        ])->post('https://api.fonnte.com/send', [
            'target'  => $phone,
            'message' => $message,
        ]);

        return $response->successful();
    }
}