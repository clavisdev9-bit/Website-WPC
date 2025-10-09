<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;


// ini bawaan laravel
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Jadwal sinkronisasi kontak 
Schedule::call(function () {
    try {
        $response = Http::get('http://127.0.0.1:8000/api/contacts/sync');
        // $response = Http::get('https://yourdomain.com/api/contacts/sync');

        if ($response->successful()) {
            Log::info('Kontak berhasil disinkronisasi', ['time' => now()]);
        } else {
            Log::error('Gagal sinkronisasi kontak', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        }
    } catch (\Exception $e) {
        Log::error('⚠️ Error saat sync kontak', ['message' => $e->getMessage()]);
    }
})
->timezone('Asia/Jakarta')
// ->hourly(); //untuk 1 jam sekali
->dailyAt('16:15'); // jalan tiap jam 12 siang WIB 
// ->everyMinute(); //untuk pengujian atau manual bisa sync setiap waktu
// ->withoutOverlapping(); // tidak dijalankan lagi kalau masih proses berguna untuk banyak scheduler untuk antrian






