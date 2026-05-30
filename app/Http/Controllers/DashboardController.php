<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function notifyFeeding(Request $request)
    {
        $portion = $request->input('portion', 0);
        $weight = $request->input('weight', 0);
        $time = now()->timezone('Asia/Jakarta')->format('H:i');
        $petName = $request->input('pet_name', session('pet_name', 'Anabul'));

        $message = "🐾 *PawFeeder Alert!*\n\n"
            . "✅ {$petName} baru saja diberi makan!\n"
            . "🍽️ Porsi: {$portion}g\n"
            . "⚖️ Sisa makanan: {$weight}g\n"
            . "🕐 Waktu: {$time} WIB\n\n"
            . "_Pesan otomatis dari PawFeeder_ 🤖";


        $uid = session('firebase_uid');

        //default hp
        $targetPhone = config('services.fonnte.phone');

        if ($uid) {
            $firebaseUrl = config('services.firebase.database_url');

            $response = Http::get("{$firebaseUrl}/users/{$uid}/profile/no_hp.json");

            if ($response->successful() && $response->json() !== null) {
                $targetPhone = $response->json();
            }
        }

        Http::withHeaders([
            'Authorization' => config('services.fonnte.token')
        ])->post('https://api.fonnte.com/send', [
                    'target' => $targetPhone,
                    'message' => $message,
                ]);

        return response()->json(['status' => 'sent']);
    }

    public function notifyLowStock(Request $request)
    {
        $weight = $request->input('weight', 0);
        $time = now()->timezone('Asia/Jakarta')->format('H:i');
        $petName = $request->input('pet_name', session('pet_name', 'Anabul'));

        $message = "⚠️ *PawFeeder Alert!*\n\n"
            . "🪣 Stok makanan {$petName} hampir habis!\n"
            . "📦 Sisa: {$weight}g\n"
            . "🕐 Waktu: {$time} WIB\n\n"
            . "Segera isi ulang makanan! 🙏\n\n"
            . "_Pesan otomatis dari PawFeeder_ 🤖";

            
        $uid = session('firebase_uid');

        //default hp
        $targetPhone = config('services.fonnte.phone');

        if ($uid) {
            $firebaseUrl = config('services.firebase.database_url');

            $response = Http::get("{$firebaseUrl}/users/{$uid}/profile/no_hp.json");

            if ($response->successful() && $response->json() !== null) {
                $targetPhone = $response->json();
            }
        }

        Http::withHeaders([
            'Authorization' => config('services.fonnte.token')
        ])->post('https://api.fonnte.com/send', [
                    'target' => $targetPhone,
                    'message' => $message,
                ]);

        return response()->json(['status' => 'sent']);
    }
}