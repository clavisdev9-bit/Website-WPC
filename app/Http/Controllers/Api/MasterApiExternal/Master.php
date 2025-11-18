<?php

namespace App\Http\Controllers\Api\MasterApiExternal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Master extends Controller
{
   
      
        // code get country dengan  code dan caching
        public function countries()
        {
            $externalUrl = "https://0e3242f7df3f.ngrok-free.app/countries";
            try {
                // Ambil data dari cache dulu, kalau tidak ada baru fetch
                $countries = Cache::remember('countries_data', 300, function() use ($externalUrl) { // cache 5 menit
                    // Retry 3x jika gagal, jeda 100ms
                    $response = Http::retry(3, 100)->withOptions([
                        'verify' => false, // Hanya untuk DEV, PROD sebaiknya true
                        'timeout' => 15
                    ])->get($externalUrl);

                    if ($response->failed()) {
                        Log::error('Failed to fetch countries from external API', [
                            'status' => $response->status(),
                            'body' => $response->body()
                        ]);
                        return []; // fallback ke array kosong
                    }

                    $data = $response->json();
                    $countriesRaw = $data['data'] ?? $data;

                    // Validasi dan pastikan struktur data konsisten
                    $countriesValidated = array_map(function($item) {
                        return [
                            'id'   => $item['id'] ?? null,
                            'name' => $item['name'] ?? 'Unknown',
                            'code' => $item['code'] ?? null // tambahkan ini!
                        ];
                    }, $countriesRaw);


                    return $countriesValidated;
                });

                return response()->json([
                    "success" => true,
                    "data" => $countries,
                    "count" => count($countries)
                ]);

            } catch (\Exception $e) {
                Log::error('Exception when fetching countries', ['message' => $e->getMessage()]);
                return response()->json([
                    "success" => false,
                    "message" => "External service unavailable: " . $e->getMessage()
                ], 503);
            }
        }


        public function statesByCountry($countryId)
            {
                $externalUrlState = "https://0e3242f7df3f.ngrok-free.app/states/country/{$countryId}";

                try {
                    // Gunakan cache berdasarkan countryId → contoh: states_data_3
                    $cacheKey = "states_data_{$countryId}";

                    $states = Cache::remember($cacheKey, 300, function() use ($externalUrlState) { // cache 5 menit

                        // Retry 3 kali jika gagal
                        $response = Http::retry(3, 100)->withOptions([
                            'verify' => false, // Dev only
                            'timeout' => 15
                        ])->get($externalUrlState);

                        if ($response->failed()) {
                            Log::error('Failed to fetch states from API', [
                                'status' => $response->status(),
                                'body' => $response->body()
                            ]);

                            return []; // fallback
                        }

                        $data = $response->json();
                        $statesRaw = $data['data'] ?? $data;

                        // Validasi per item agar stabil
                        $statesValidated = array_map(function($item) {
                            return [
                                'id'        => $item['id'] ?? null,
                                'name'      => $item['name'] ?? 'Unknown',
                                'countryId' => $item['country_id'] ?? null,
                                'code'      => $item['code'] ?? null,
                            ];
                        }, $statesRaw);

                        return $statesValidated;
                    });

                    return response()->json([
                        "success" => true,
                        "data" => $states,
                        "count" => count($states)
                    ]);

                } catch (\Exception $e) {
                    Log::error('Exception when fetching states', ['message' => $e->getMessage()]);
                    return response()->json([
                        "success" => false,
                        "message" => "External service unavailable: " . $e->getMessage()
                    ], 503);
                }
            }


                public function pickupOrigins(Request $request)
        {
            $transportation = $request->query('transportation'); 
            $externalUrl = "https://0e3242f7df3f.ngrok-free.app/lookups/pickup-origins";

            try {
                // Cache per transportation (misal: air, sea, trucking)
                $cacheKey = "pickup_origins_" . ($transportation ?? 'all');

                $origins = Cache::remember($cacheKey, 300, function () use ($externalUrl, $transportation) {

                    // Retry 3x jika API gagal / lemot
                    $response = Http::retry(3, 150)->withOptions([
                        'verify' => env('HTTP_VERIFY_SSL', false),
                        'timeout' => 15,
                    ])->get($externalUrl, [
                        'transportation' => $transportation
                    ]);

                    if ($response->failed()) {
                        Log::error("Failed to fetch pickup origins", [
                            "status" => $response->status(),
                            "body"   => $response->body()
                        ]);
                        return [];
                    }

                    $data = $response->json();
                    $items = $data['data'] ?? [];

                    return array_map(function ($item) {

                        // country kadang array, kadang null -> normalisasi aman
                        $countryId = null;
                        if (isset($item['country']) && is_array($item['country']) && count($item['country']) > 0) {
                            $countryId = $item['country'][0];
                        }

                        return [
                            'id'                      => $item['id'] ?? null,
                            'pickup_origin_address'   => $item['pickup_origin_address'] ?? null,
                            'country_id'              => $countryId,
                            'country_name'            => $item['country_name'] ?? null,
                            'pickup_code'             => $item['pickup_code'] ?? null,

                            // tambahan untuk Vue <select> label
                            'name' => trim(
                                ($item['pickup_origin_address'] ?? '') .
                                ' (' . ($item['country_name'] ?? '') . ')'
                            ),
                        ];
                    }, $items);
                });

                return response()->json([
                    "success" => true,
                    "data"    => $origins,
                    "count"   => count($origins)
                ]);

            } catch (\Throwable $e) {

                Log::error("Pickup Origins API Exception", [
                    "error" => $e->getMessage()
                ]);

                return response()->json([
                    "success" => false,
                    "message" => "External service unavailable",
                    "error"   => $e->getMessage()
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

        // cache key unik berdasarkan transportation
        $cacheKey = "pickup_destinations_" . $transportation;

        try {

            $destinations = Cache::remember($cacheKey, 30 * 60, function () use ($transportation) {

                $externalUrl = "https://0e3242f7df3f.ngrok-free.app/lookups/pickup-destinations";

                $response = Http::withOptions([
                    'verify' => false,
                    'timeout' => 15
                ])->get($externalUrl, [
                    'transportation' => $transportation
                ]);

                if ($response->failed()) {
                    throw new \Exception("Failed fetching pickup destinations");
                }

                $data = $response->json();
                $destinations = $data['data'] ?? [];

                // Normalisasi data
                return array_map(function ($item) {
                    return [
                        'id' => $item['id'] ?? null,
                        'destination_address' =>
                            $item['pickup_destination_address']
                            ?? ($item['destination'] ?? null),

                        'country_id' => $item['country'][0] ?? null,
                        'country_name' => $item['country_name'] ?? null,

                        'name' =>
                            ($item['pickup_destination_address']
                                ?? ($item['destination'] ?? '')) .
                            ' (' . ($item['country_name'] ?? '') . ')'
                    ];
                }, $destinations);
            });

            return response()->json([
                "success" => true,
                "data" => $destinations,
                "count" => count($destinations)
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                "success" => false,
                "message" => "External service unavailable",
                "error" => $e->getMessage()
            ], 503);
        }
    }



            
                public function commodity()
            {
                $externalUrl = "https://0e3242f7df3f.ngrok-free.app/lookups/commodities";

                try {
                    $cacheKey = "commodity_data";

                    // Cache 5 menit (300 detik) - ubah sesuai kebutuhan
                    $commodities = Cache::remember($cacheKey, 300, function () use ($externalUrl) {

                        // Retry 3x jika API lambat / nggak stabil
                        $response = Http::retry(3, 100)->withOptions([
                            'verify' => env('HTTP_VERIFY_SSL', false), 
                            'timeout' => 10
                        ])->get($externalUrl);

                        if ($response->failed()) {
                            Log::error("Failed to fetch commodities", [
                                'status' => $response->status(),
                                'body'   => $response->body(),
                            ]);

                            return []; // fallback kosong
                        }

                        $data = $response->json() ?? [];
                        $raw = $data['data'] ?? $data;

                        // Validasi dan jaga agar data konsisten
                        return array_map(function($item) {
                            return [
                                'id'   => $item['id'] ?? null,
                                'name' => $item['name'] ?? null,
                                'code' => $item['code'] ?? null,
                            ];
                        }, $raw);
                    });

                    return response()->json([
                        "success" => true,
                        "data" => $commodities,
                        "count" => count($commodities)
                    ]);

                } catch (\Throwable $e) {

                    Log::error("Commodity API exception", [
                        "error" => $e->getMessage()
                    ]);

                    return response()->json([
                        "success" => false,
                        "message" => "External service unavailable",
                        "error" => $e->getMessage(),
                    ], 503);
                }
            }

        
            public function unitOfMeasure()
        {
            $externalUrl = "https://0e3242f7df3f.ngrok-free.app/lookups/uoms";

            try {
                $cacheKey = "uoms_data";

                // Cache 5 menit (300 detik)
                $uoms = Cache::remember($cacheKey, 300, function () use ($externalUrl) {

                    // Retry 3x otomatis jika API lemot / tidak stabil
                    $response = Http::retry(3, 100)->withOptions([
                        'verify' => env('HTTP_VERIFY_SSL', false),
                        'timeout' => 10
                    ])->get($externalUrl);

                    if ($response->failed()) {
                        Log::error("Failed to fetch UOMs", [
                            'status' => $response->status(),
                            'body' => $response->body(),
                        ]);
                        return []; // fallback
                    }

                    $data = $response->json() ?? [];
                    $raw = $data['data'] ?? $data;

                    // Validasi agar tidak ada undefined
                    return array_map(function ($item) {
                        return [
                            'id'     => $item['id'] ?? null,
                            'name'   => $item['name'] ?? null,
                            'factor' => $item['factor'] ?? null,
                        ];
                    }, $raw);
                });

                return response()->json([
                    "success" => true,
                    "data" => $uoms,
                    "count" => count($uoms)
                ]);

            } catch (\Throwable $e) {

                Log::error("UOM API exception", [
                    "error" => $e->getMessage()
                ]);

                return response()->json([
                    "success" => false,
                    "message" => "External service unavailable",
                    "error" => $e->getMessage(),
                ], 503);
            }
        }
}
