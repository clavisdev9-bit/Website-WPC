<?php

namespace App\Http\Controllers\Api\MasterApiExternal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Master extends Controller
{
   

        public function countries()
        {
            $externalUrl = "https://political-gerard-uncertainly.ngrok-free.app/countries";

            try {
                // SOLUSI: Nonaktifkan verifikasi SSL (HANYA UNTUK DEV LOKAL Jika Prod true kan verify)
                $response = Http::withOptions([
                    'verify' => false, 
                    'timeout' => 15
                ])->get($externalUrl); 

                if ($response->failed()) {
                    return response()->json([
                        "success" => false,
                        "message" => "Failed to fetch Country from external API"
                    ], $response->status() ?: 500);
                }

                $data = $response->json();
                $countries = $data['data'] ?? $data;

                return response()->json([
                    "success" => true,
                    "data" => $countries,
                    "count" => count($countries)
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    "success" => false,
                    "message" => "External service unavailable: " . $e->getMessage()
                ], 503);
            }
        }



        public function statesByCountry($countryId)
        {
            $externalUrlState = "http://political-gerard-uncertainly.ngrok-free.app/states/country/{$countryId}";

            try {
                // SOLUSI: Nonaktifkan verifikasi SSL (HANYA UNTUK DEV LOKAL Jika Prod true kan verify)
                $response = Http::withOptions([
                    'verify' => false,
                    'timeout' => 15
                ])->get($externalUrlState);

                if ($response->failed()) {
                    return response()->json([
                        "success" => false,
                        "message" => "Failed to fetch States from external API"
                    ], $response->status() ?: 500);
                }

                $data = $response->json();
                $states = $data['data'] ?? $data;

                return response()->json([
                    "success" => true,
                    "data" => $states,
                    "count" => count($states)
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    "success" => false,
                    "message" => "External service unavailable: " . $e->getMessage()
                ], 503);
            }
        }





        public function pickupOrigins(Request $request)
            {
                $transportation = $request->query('transportation'); 

                $externalUrl = "https://political-gerard-uncertainly.ngrok-free.app/lookups/pickup-origins";

                try {
                    $response = Http::withOptions([
                        'verify' => false, // matikan SSL verify hanya untuk dev
                        'timeout' => 15,
                    ])->get($externalUrl, [
                        'transportation' => $transportation
                    ]);

                    if ($response->failed()) {
                        return response()->json([
                            "success" => false,
                            "message" => "Failed to fetch Pickup Origins"
                        ], $response->status() ?: 500);
                    }

                    $data = $response->json();
                    $origins = $data['data'] ?? [];

                    // Normalisasi + tetap simpan field penting
                    $filtered = array_map(function ($item) {
                        return [
                            'id'   => $item['id'] ?? null,
                            'pickup_origin_address' => $item['pickup_origin_address'] ?? null,
                            'country_id'            => $item['country'][0] ?? null,
                            'country_name'          => $item['country_name'] ?? null,
                            'pickup_code'           => $item['pickup_code'] ?? null,

                            // tambahan untuk label Vue
                            'name' => ($item['pickup_origin_address'] ?? '') . 
                                    ' (' . ($item['country_name'] ?? '') . ')'
                        ];
                    }, $origins);

                    return response()->json([
                        "success" => true,
                        "data"    => $filtered,
                        "count"   => count($filtered)
                    ]);

                } catch (\Exception $e) {
                    return response()->json([
                        "success" => false,
                        "message" => "External service unavailable: " . $e->getMessage()
                    ], 503);
                }
            }




    public function pickupDestinations(Request $request)
    {
        $transportation = $request->query('transportation');

        if (!$transportation) {
            return response()->json([
                "success" => false,
                "message" => "Parameter transportation is required"
            ], 400);
        }

        $externalUrl = "https://political-gerard-uncertainly.ngrok-free.app/lookups/pickup-destinations";

        try {
            $response = Http::withOptions([
                'verify' => false,
                'timeout' => 15,
            ])->get($externalUrl, [
                'transportation' => $transportation
            ]);

            if ($response->failed()) {
                return response()->json([
                    "success" => false,
                    "message" => "Failed to fetch Pickup Destinations"
                ], $response->status() ?: 500);
            }

            $data = $response->json();
            $destinations = $data['data'] ?? [];

            // Normalisasi + tetap simpan field penting
            $filtered = array_map(function ($item) {
                return [
                    'id' => $item['id'] ?? null,
                    // misalnya API punya field 'pickup_destination_address' atau 'destination'
                    'destination_address' => $item['pickup_destination_address'] ?? ($item['destination'] ?? null),
                    'country_id' => $item['country'][0] ?? null,
                    'country_name' => $item['country_name'] ?? null,
                    // tambahan label untuk Vue
                    'name' => 
                      ($item['pickup_destination_address'] ?? ($item['destination'] ?? '')) . 
                      ' (' . ($item['country_name'] ?? '') . ')'
                ];
            }, $destinations);

            return response()->json([
                "success" => true,
                "data" => $filtered,
                "count" => count($filtered)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "External service unavailable: " . $e->getMessage()
            ], 503);
        }
    }
}
