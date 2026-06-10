<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FirebaseService
{
    protected string $apiKey;
    protected string $databaseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.firebase.api_key');
        $this->databaseUrl = config('services.firebase.database_url');
    }

    public function saveUserProfile($uid, $data)
    {
        $url = "{$this->databaseUrl}/users/{$uid}/profile.json?auth=" . session('firebase_token');

        $response = Http::put($url, $data);

        return $response->json();
    }

    public function register(string $email, string $password): array
    {
        $response = Http::post(
            "https://identitytoolkit.googleapis.com/v1/accounts:signUp?key={$this->apiKey}",
            [
                'email' => $email,
                'password' => $password,
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
                'email' => $email,
                'password' => $password,
                'returnSecureToken' => true,
            ]
        );

        return $response->json();
    }

    public function deleteAccount(string $idToken): array
    {
        $response = Http::post(
            "https://identitytoolkit.googleapis.com/v1/accounts:delete?key={$this->apiKey}",
            [
                'idToken' => $idToken
            ]
        );

        // return $response->json();
        dd($response->json());
    }
}