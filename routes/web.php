<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::post('/signup', [AuthController::class, 'register'])->name('signup.post');

Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('login');
})->name('logout');

Route::get('/dashboard', function () {
    if (!session('firebase_uid')) {
        return redirect()->route('login');
    }

    $uid = session('firebase_uid');
    $firebaseUrl = env('FIREBASE_DATABASE_URL');

    // Ambil pet_name dari Firebase berdasarkan UID
    $response = \Illuminate\Support\Facades\Http::get("{$firebaseUrl}/users/{$uid}/pet_name.json");
    $petName = $response->json(); // null kalau belum diset

    return view('dashboard', compact('petName'));
})->name('dashboard');

Route::get('/jadwal', function () {
    if (!session('firebase_uid')) return redirect()->route('login');
    return view('jadwal');
})->name('jadwal');

Route::get('/statistik', function () {
    if (!session('firebase_uid')) return redirect()->route('login');
    return view('statistik');
})->name('statistik');

Route::get('/pengaturan', function () {
    if (!session('firebase_uid')) return redirect()->route('login');
    return view('pengaturan');
})->name('pengaturan');

Route::get('/notifikasi', function () {
    if (!session('firebase_uid')) return redirect()->route('login');
    return view('notifikasi');
})->name('notifikasi');

Route::post('/notify-feeding', [DashboardController::class, 'notifyFeeding']);
Route::post('/notify-low-stock', [DashboardController::class, 'notifyLowStock']);
Route::post('/save-pet-name', [DashboardController::class, 'savePetName']);