<?php

namespace App\Http\Controllers\Api\MasterApiExternal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Commodity;
use App\Models\Uoms;
use Exception;

class MasterSync extends Controller
{
       

         // GET: Ambil data commodities dari tabel lokal
    public function MasterCommodity()
    {
        try {
            $data = Commodity::orderBy('name')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data commodities lokal',
                'data' => $data,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data lokal',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // POST: Sync dari API eksternal ke database lokal
    public function syncCommodities(Request $request)
    {
        try {
            $url = "https://1821986ae1e4.ngrok-free.app/lookups/commodities";
          $response = Http::withOptions(['verify' => false])
                        ->timeout(10)
                        ->get($url);
            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memanggil API eksternal',
                    'detail'  => $response->body(),
                ], 500);
            }

            $items = $response->json()['data'] ?? [];

            foreach ($items as $item) {
                Commodity::updateOrCreate(
                    ['external_id' => $item['id']],
                    [
                        'name' => $item['name'],
                        'code' => $item['code'] ?? null,
                    ]
                );
            }
            return response()->json([
                'success' => true,
                'message' => 'Sinkronisasi berhasil',
                'count' => count($items),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat sync',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




    // GET: Ambil data commodities dari tabel lokal
    public function MasterUoms()
    {
        try {
            $data = Uoms::orderBy('name')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data UOM lokal',
                'data' => $data,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data lokal',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




   public function syncUoms()
{
    try {
        $response = Http::withOptions(['verify' => false])
            ->timeout(10)
            ->get('https://1821986ae1e4.ngrok-free.app/lookups/uoms');

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal ambil data UOM'
            ], 500);
        }

        foreach ($response->json()['data'] as $item) {

            Uoms::updateOrCreate(
                ['external_id' => $item['id']],     // pencocokan
                [
                    'name' => $item['name'],
                    'factor' => $item['factor'],
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Sync UOM berhasil'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat sync',
            'error' => $e->getMessage()
        ], 500);
    }
}



}
