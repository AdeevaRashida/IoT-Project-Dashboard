<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request, FirebaseService $firebase)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'name' => 'required|string',
        ]);

        $result = $firebase->register($request->email, $request->password);

        // 1. PINDAHKAN PENGECEKAN ERROR KE SINI (DI ATAS SAVE USER PROFILE)
        if (isset($result['error'])) {
            $message = match ($result['error']['message']) {
                'EMAIL_EXISTS' => 'Email sudah terdaftar.',
                'WEAK_PASSWORD' => 'Password minimal 6 karakter.',
                default => 'Terjadi kesalahan: ' . $result['error']['message'],
            };
            return back()->withErrors(['email' => $message])->withInput();
        }

        // 2. JIKA DIJAMIN TIDAK ERROR, BARU SIMPAN KE REALTIME DATABASE
        $firebase->saveUserProfile($result['localId'], [
            'name' => $request->name,
            'email' => $request->email,
            'created_at' => now()->toIso8601String(),
        ]);

        // 3. Simpan token & info user ke session
        session([
            'firebase_token' => $result['idToken'],
            'firebase_uid' => $result['localId'],
            'user_email' => $result['email'],
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
    }
    public function login(Request $request, FirebaseService $firebase)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $result = $firebase->login($request->email, $request->password);

        if (isset($result['error'])) {
            $message = match (true) {
                str_contains($result['error']['message'], 'INVALID_LOGIN_CREDENTIALS') => 'Email atau password salah.',
                str_contains($result['error']['message'], 'TOO_MANY_ATTEMPTS') => 'Terlalu banyak percobaan, coba lagi nanti.',
                default => 'Terjadi kesalahan: ' . $result['error']['message'],
            };
            return back()->withErrors(['email' => $message]);
        }

        session([
            'firebase_token' => $result['idToken'],
            'firebase_uid' => $result['localId'],
            'user_email' => $result['email'],
        ]);

        return redirect()->route('dashboard');
    }

    public function deleteAccount(FirebaseService $firebase)
    {
        $idToken = session('firebase_token');

        if ($idToken) {
            $firebase->deleteAccount($idToken);
        }

        session()->flush();

        return response()->json(['success' => true]);
    }
}