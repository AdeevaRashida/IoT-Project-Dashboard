<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request, FirebaseService $firebase)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
            'name'     => 'required|string',
        ]);

        $result = $firebase->register($request->email, $request->password);

        // Cek kalau ada error dari Firebase
        if (isset($result['error'])) {
            $message = match($result['error']['message']) {
                'EMAIL_EXISTS'     => 'Email sudah terdaftar.',
                'WEAK_PASSWORD'    => 'Password minimal 6 karakter.',
                default            => 'Terjadi kesalahan: ' . $result['error']['message'],
            };
            return back()->withErrors(['email' => $message]);
        }

        // Simpan token & info user ke session
        session([
            'firebase_token' => $result['idToken'],
            'firebase_uid'   => $result['localId'],
            'user_email'     => $result['email'],
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
    }
    public function login(Request $request, FirebaseService $firebase)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $result = $firebase->login($request->email, $request->password);

    if (isset($result['error'])) {
        $message = match(true) {
            str_contains($result['error']['message'], 'INVALID_LOGIN_CREDENTIALS') => 'Email atau password salah.',
            str_contains($result['error']['message'], 'TOO_MANY_ATTEMPTS')          => 'Terlalu banyak percobaan, coba lagi nanti.',
            default => 'Terjadi kesalahan: ' . $result['error']['message'],
        };
        return back()->withErrors(['email' => $message]);
    }

    session([
        'firebase_token' => $result['idToken'],
        'firebase_uid'   => $result['localId'],
        'user_email'     => $result['email'],
    ]);

    return redirect()->route('dashboard');
}
}