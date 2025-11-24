<?php

namespace App\Http\Controllers\Api\LogicApiExternal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;




class Qoutation extends Controller
{

    // public function createQuotation(Request $request)
    // {
    //     $externalUrl = "https://0e3242f7df3f.ngrok-free.app/quote/create";
    //     try {
    //         $response = Http::withOptions([
    //             'verify' => false,
    //             'timeout' => 15
    //         ])->post($externalUrl, $request->all());

    //         if ($response->failed()) {
    //             return response()->json([
    //                 "success" => false,
    //                 "message" => "Failed to create quote"
    //             ], $response->status() ?: 500);
    //         }

    //         return response()->json($response->json(), $response->status());

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             "success" => false,
    //             "message" => "Service unavailable: " . $e->getMessage()
    //         ], 503);
    //     }
    // }

   
//     public function createQuotation(Request $request)
// {
//     $externalUrl = "https://0e3242f7df3f.ngrok-free.app/quote/create";

//     try {
//         $response = Http::withOptions([
//             'verify' => false,
//             'timeout' => 15
//         ])->post($externalUrl, $request->all())->throw();

//         // Ambil response API eksternal apa adanya
//         $result = $response->json();

//         return response()->json($result, $response->status());

//     } catch (\Throwable $e) {
//         return response()->json([
//             "success" => false,
//             "message" => "Failed to create quotation",
//             "error" => $e->getMessage(),
//         ], 503);
//     }
// }



public function createQuotation(Request $request)
{
    // -----------------------------------------------
    // 1. Anti-bot: Honeypot (hidden field)
    // Jika field terisi → bot
    // -----------------------------------------------
    if ($request->filled('extra_field')) {
        return response()->json([
            'success' => false,
            'message' => 'Bot detected (honeypot triggered)'
        ], 400);
    }

    // -----------------------------------------------
    // 2. Anti-bot: Waktu minimum kirim form
    // Buat aturan: minimal 3 detik setelah form load
    // -----------------------------------------------
    $now   = microtime(true);
    $start = floatval($request->input('timestamp'));

    if ($start > 0 && ($now - $start) < 3) { // 3 detik minimal
        return response()->json([
            'success' => false,
            'message' => 'Bot detected (submitted too fast)'
        ], 400);
    }

    // -----------------------------------------------
    // 3. Jika lolos → teruskan ke Odoo
    // -----------------------------------------------
    $externalUrl = "https://0e3242f7df3f.ngrok-free.app/quote/create";

    try {
        $response = Http::withOptions([
            'verify' => false,
            'timeout' => 15
        ])->post($externalUrl, $request->all())->throw();

        return response()->json(
            $response->json(),
            $response->status()
        );

    } catch (\Throwable $e) {
        return response()->json([
            "success"  => false,
            "message"  => "Failed to create quotation",
            "error"    => $e->getMessage(),
        ], 503);
    }
}


}
