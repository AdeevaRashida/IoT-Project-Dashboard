<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FirebaseService
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.firebase.api_key');
    }

    public function register(string $email, string $password): array
    {
        $response = Http::post(
            "https://identitytoolkit.googleapis.com/v1/accounts:signUp?key={$this->apiKey}",
            [
                'email'             => $email,
                'password'          => $password,
                'returnSecureToken' => true,
            ]
        );

        return $response->json();
    }
    public function login(string $email, string $password): array
{
    $response = Http::post(
        "https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key={$this->apiKey}",
        [
            'email'             => $email,
            'password'          => $password,
            'returnSecureToken' => true,
        ]
    );

    return $response->json();
}
}