<?php

namespace App\Services;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Bry
{
    public $token;
    public $URLCarimbo = "https://fw2.bry.com.br/api/carimbo-service/v1/timestamps";
    public function __construct()
    {

        $this->getToken();

    }

    public function getToken() {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $options = [
            'grant_type' => 'client_credentials',
            'client_id' => 'b220c26a-9f0c-4021-913d-6edf879a13ce',
            'client_secret' => 'PT7dhLS0yCbcZQzt1n45tFB+2lALGan9VvdzJsAvZ6TkJ3PSoCdpMw=='
        ];
        $get = \Http::withHeaders($headers)->asForm()->post('https://cloud.bry.com.br/token-service/jwt', $options);
        $this->token = $get->json()['access_token'];

    }

    public function signatureHash($id, $hashDoDocumento) {
        $body = [
            "documents" => [
                [
                    "content" => $hashDoDocumento,
                    "nonce" => 0
                ]
            ],
            "format" => "HASH",
            "hashAlgorithm" => "SHA256",
            "nonce" => $id
        ];

        $header = [
            'Authorization' => 'Bearer ' . $this->token,
        ];

        $send = Http::withHeaders($header)->post('https://fw2.bry.com.br/api/carimbo-service/v1/timestamps', $body);
        $save = Schedule::find($id);
        $save->time_stamp = $send;
        $save->save();
    }

    public function signatureDoc($id, $hashDoDocumento) {
        $body = [
            "documents" => [
                [
                    "content" => $hashDoDocumento,
                    "nonce" => 0
                ]
            ],
            "format" => "HASH",
            "hashAlgorithm" => "SHA256",
            "nonce" => $id
        ];

        $header = [
            'Authorization' => 'Bearer ' . $this->token,
        ];

        $send = Http::withHeaders($header)->post('https://fw2.bry.com.br/api/carimbo-service/v1/timestamps', $body);
        $save = Schedule::find($id);
        $save->time_stamp_document = $send;
        $save->save();
    }

    public function verify($id) {

        $schedule = Schedule::find($id);
        $timestamp = json_decode($schedule->time_stamp, true);

        $body = [
            "contentReturn" => true,
            "mode" => "BASIC",
        ];

        $result = array_merge($body, $timestamp);

        dd($result);

        $header = [
            'Authorization' => 'Bearer ' . $this->token,
        ];

        $send = Http::withHeaders($header)->post('https://fw2.bry.com.br/api/carimbo-service/v1/timestamps/verify', $result);
        dd($send->json());
    }
}
