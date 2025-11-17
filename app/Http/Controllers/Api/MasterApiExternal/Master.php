<?php

namespace App\Http\Controllers\Api\MasterApiExternal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Master extends Controller
{
   
        // ambil negara
        // public function countries()
        // {
          
        //     $externalUrl = "https://0e3242f7df3f.ngrok-free.app/countries";
        //     try {
        //         // SOLUSI: Nonaktifkan verifikasi SSL (HANYA UNTUK DEV LOKAL Jika Prod true kan verify)
        //         $response = Http::withOptions([
        //             'verify' => false, 
        //             'timeout' => 15
        //         ])->get($externalUrl); 

        //         if ($response->failed()) {
        //             return response()->json([
        //                 "success" => false,
        //                 "message" => "Failed to fetch Country from external API"
        //             ], $response->status() ?: 500);
        //         }

        //         $data = $response->json();
        //         $countries = $data['data'] ?? $data;

        //         return response()->json([
        //             "success" => true,
        //             "data" => $countries,
        //             "count" => count($countries)
        //         ]);

        //     } catch (\Exception $e) {
        //         return response()->json([
        //             "success" => false,
        //             "message" => "External service unavailable: " . $e->getMessage()
        //         ], 503);
        //     }
        // }

       public function countries()
        {
            $externalUrl = "https://0e3242f7df3f.ngrok-free.app/countries";

            try {

                $response = Http::withOptions([
                    'verify' => env('HTTP_VERIFY_SSL', false), // Prod=true
                    'timeout' => 10
                ])->get($externalUrl)->throw();

                $data = $response->json() ?? [];

                $countries = $data['data'] ?? $data;

                return response()->json([
                    "success" => true,
                    "data" => $countries,
                    "count" => count($countries)
                ]);

            } catch (\Throwable $e) {

                return response()->json([
                    "success" => false,
                    "message" => "External service unavailable",
                    "error"   => $e->getMessage(),
                ], 503);
            }
        }



        // ambil state
        public function statesByCountry($countryId)
        {
           
            $externalUrlState = "https://0e3242f7df3f.ngrok-free.app/states/country/{$countryId}";

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



        // ambil pickup origin
        public function pickupOrigins(Request $request)
            {
                $transportation = $request->query('transportation'); 

                $externalUrl = "https://0e3242f7df3f.ngrok-free.app/lookups/pickup-origins";

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



    //  ambil pickup destinasi
    public function pickupDestinations(Request $request)
    {
        $transportation = $request->query('transportation');

        if (!$transportation) {
            return response()->json([
                "success" => false,
                "message" => "Parameter transportation is required"
            ], 400);
        }

        $externalUrl = "https://0e3242f7df3f.ngrok-free.app/lookups/pickup-destinations";

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



    //  public function commodity()
    //     {
          
    //         $externalUrl = "https://0e3242f7df3f.ngrok-free.app/lookups/commodities";

    //         try {
    //             // SOLUSI: Nonaktifkan verifikasi SSL (HANYA UNTUK DEV LOKAL Jika Prod true kan verify)
    //             $response = Http::withOptions([
    //                 'verify' => false, 
    //                 'timeout' => 15
    //             ])->get($externalUrl); 

    //             if ($response->failed()) {
    //                 return response()->json([
    //                     "success" => false,
    //                     "message" => "Failed to fetch commodities from external API"
    //                 ], $response->status() ?: 500);
    //             }

    //             $data = $response->json();
    //             $commodities = $data['data'] ?? $data;

    //             return response()->json([
    //                 "success" => true,
    //                 "data" => $commodities,
    //                 "count" => count($commodities)
    //             ]);

    //         } catch (\Exception $e) {
    //             return response()->json([
    //                 "success" => false,
    //                 "message" => "External service unavailable: " . $e->getMessage()
    //             ], 503);
    //         }
    //     }

            public function commodity()
        {
            $externalUrl = "https://0e3242f7df3f.ngrok-free.app/lookups/commodities";

            try {

                $response = Http::withOptions([
                    'verify' => env('HTTP_VERIFY_SSL', false), // DEV=false, PROD=true
                    'timeout' => 10
                ])->get($externalUrl)->throw(); // otomatis throw error kalau gagal

                $data = $response->json() ?? [];

                $commodities = $data['data'] ?? $data;

                return response()->json([
                    "success" => true,
                    "data" => $commodities,
                    "count" => count($commodities)
                ]);

            } catch (\Throwable $e) {

                return response()->json([
                    "success" => false,
                    "message" => "External service unavailable",
                    "error" => $e->getMessage(),
                ], 503);
            }
        }



        // public function uom()
        // {
          
        //     $externalUrl = "https://0e3242f7df3f.ngrok-free.app/lookups/uoms";

        //     try {
        //         // SOLUSI: Nonaktifkan verifikasi SSL (HANYA UNTUK DEV LOKAL Jika Prod true kan verify)
        //         $response = Http::withOptions([
        //             'verify' => false, 
        //             'timeout' => 15
        //         ])->get($externalUrl); 

        //         if ($response->failed()) {
        //             return response()->json([
        //                 "success" => false,
        //                 "message" => "Failed to fetch uoms from external API"
        //             ], $response->status() ?: 500);
        //         }

        //         $data = $response->json();
        //         $uoms = $data['data'] ?? $data;

        //         return response()->json([
        //             "success" => true,
        //             "data" => $uoms,
        //             "count" => count($uoms)
        //         ]);

        //     } catch (\Exception $e) {
        //         return response()->json([
        //             "success" => false,
        //             "message" => "External service unavailable: " . $e->getMessage()
        //         ], 503);
        //     }
        // }


        public function uom()
        {
            $externalUrl = "https://0e3242f7df3f.ngrok-free.app/lookups/uoms";

            try {

                $response = Http::withOptions([
                    'verify' => env('HTTP_VERIFY_SSL', false),
                    'timeout' => 10
                ])->get($externalUrl)->throw();

                $data = $response->json() ?? [];

                $uoms = $data['data'] ?? $data;

                return response()->json([
                    "success" => true,
                    "data" => $uoms,
                    "count" => count($uoms)
                ]);

            } catch (\Throwable $e) {

                return response()->json([
                    "success" => false,
                    "message" => "External service unavailable",
                    "error"   => $e->getMessage(),
                ], 503);
            }
        }

}
