<?php

namespace App\Http\Controllers\Api\LogicApiExternal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class Qoutation extends Controller
{

    public function createQuotation(Request $request)
    {
        $externalUrl = "https://0e3242f7df3f.ngrok-free.app/quote/create";
        try {
            $response = Http::withOptions([
                'verify' => false,
                'timeout' => 15
            ])->post($externalUrl, $request->all());

            if ($response->failed()) {
                return response()->json([
                    "success" => false,
                    "message" => "Failed to create quote"
                ], $response->status() ?: 500);
            }

            return response()->json($response->json(), $response->status());

        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Service unavailable: " . $e->getMessage()
            ], 503);
        }
    }

}
