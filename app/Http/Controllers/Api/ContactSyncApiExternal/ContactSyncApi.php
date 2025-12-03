<?php

namespace App\Http\Controllers\Api\ContactSyncApiExternal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ContactModel;
use App\Models\ContactCountryModel;
use App\Models\ContactStateModel;
use App\Models\ContactTagModel;
use App\Models\ContactSyncLogModel;
use Exception;
use Illuminate\Support\Facades\Log;



class ContactSyncApi extends Controller
{
   /**
     * Menampilkan semua contact dari database lokal
     */
    public function index()
        {
            try {
                $contacts = ContactModel::with(['countries', 'states', 'tags'])
                    ->orderBy('name', 'asc')
                    ->get();

                return response()->json([
                    'success' => true,
                    'message' => 'Data contacts lokal',
                    'data' => $contacts,
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengambil kontak: ' . $e->getMessage(),
                    'data' => [],
                ], 500);
            }
        }

    // public function index()
    // {
    //     $contacts = ContactModel::with(['countries', 'states', 'tags'])
    //         ->orderBy('name', 'asc')
    //         ->get();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data contacts lokal',
    //         'data' => $contacts,
    //     ]);
    // }

    /**
     * Sinkronisasi manual data contacts dari API ke database lokal
     */
   

    // public function syncFromApi(Request $request)
    // {
    //     set_time_limit(300); // maksimal 5 menit
    //     ini_set('memory_limit', '512M'); // tambah memory jika perlu

    //     $totalRecords = 0;
    //     $logMessage = '';

    //     try {
    //         DB::beginTransaction();

    //         //  Ambil data dari API eksternal
    //         $response = Http::withoutVerifying()
    //             ->timeout(120)
    //             ->get('https://0e3242f7df3f.ngrok-free.app/contacts');
    //             dd($response);

    //         $data = $response->json();

    //         if (!$data['success']) {
    //             throw new \Exception('Gagal mengambil data dari API');
    //         }

    //         $contacts = $data['data'];

    //         foreach ($contacts as $item) {
    //             $totalRecords++;

    //             // helper untuk ubah array menjadi string
    //             $toString = fn($value) => is_array($value) ? implode(', ', $value) : $value;

    //             // pastikan contact_id selalu string atau null
    //             $contactId = isset($item['contact_id']) ? (string)$item['contact_id'] : null;

    //             // 2️ Insert / Update ke tabel contacts
    //             $contact = ContactModel::updateOrCreate(
    //                 ['id' => $item['id']],
    //                 [
    //                     'contact_id'    => $contactId,
    //                     'name'          => $toString($item['name'] ?? null),
    //                     'street'        => $toString($item['street'] ?? null),
    //                     'street2'       => $toString($item['street2'] ?? null),
    //                     'city'          => $toString($item['city'] ?? null),
    //                     'zip'           => $toString($item['zip'] ?? null),
    //                     'npwp'          => $toString($item['npwp'] ?? null),
    //                     'your_business' => $toString($item['your_business'] ?? null),
    //                     'job_position'  => $toString($item['job_position'] ?? null),
    //                     'phone'         => $toString($item['phone'] ?? null),
    //                     'mobile'        => $toString($item['mobile'] ?? null),
    //                     'email'         => $toString($item['email'] ?? null),
    //                     'website'       => $toString($item['website'] ?? null),
    //                     'title'         => $toString($item['title'] ?? null),
    //                     'language'      => $toString($item['language'] ?? null),
    //                     'company_type'  => $toString($item['company_type'] ?? null),
    //                 ]
    //             );

    //             // 3️ Hapus relasi lama
    //             ContactCountryModel::where('contact_id', $contact->id)->delete();
    //             ContactStateModel::where('contact_id', $contact->id)->delete();
    //             ContactTagModel::where('contact_id', $contact->id)->delete();

    //             // 4️ Simpan relasi country
    //             if (!empty($item['country']) && is_array($item['country'])) {
    //                 foreach ($item['country'] as $country) {
    //                     ContactCountryModel::create([
    //                         'contact_id'   => $contact->id,
    //                         'country_id'   => $country['country_id'] ?? null,
    //                         'country_name' => $country['country_name'] ?? null,
    //                     ]);
    //                 }
    //             }

    //             // 5️ Simpan relasi state
    //             if (!empty($item['state']) && is_array($item['state'])) {
    //                 foreach ($item['state'] as $state) {
    //                     ContactStateModel::create([
    //                         'contact_id' => $contact->id,
    //                         'state_id'   => $state['state_id'] ?? null,
    //                         'state_name' => $state['state_name'] ?? null,
    //                     ]);
    //                 }
    //             }

    //             // 6️ Simpan relasi tags
    //             if (!empty($item['tags']) && is_array($item['tags'])) {
    //                 foreach ($item['tags'] as $tag) {
    //                     ContactTagModel::create([
    //                         'contact_id' => $contact->id,
    //                         'tag_id'     => $tag['id'] ?? null,
    //                         'tag_name'   => $tag['name'] ?? null,
    //                     ]);
    //                 }
    //             }
    //         }

    //         DB::commit();
    //         $logMessagess = "Sinkronisasi berhasil dijalankan. Total data: {$totalRecords}. Waktu: " . now()->format('d-m-Y H:i:s');

    //         // 7️ Simpan log sinkronisasi
    //         DB::table('contact_sync_logs')->insert([
    //             'sync_time'     => now(),
    //             'total_records' => $totalRecords,
    //             'status'        => 'success',
    //             'message'       => $logMessagess,
    //             'created_at'    => now(),
    //             'updated_at'    => now(),
    //         ]);

    //           if (!$request->ajax()) {
    //                 return redirect()
    //                 ->route('Admin.quotation.system.contact.sync')
    //                 ->with('success', 'Sinkronisasi data kontak berhasil!');
    //             }


    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Sinkronisasi data kontak berhasil!',
    //             'total_records' => $totalRecords
    //         ]);

    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         // Simpan log gagal
    //         DB::table('contact_sync_logs')->insert([
    //             'sync_time'     => now(),
    //             'total_records' => $totalRecords,
    //             'status'        => 'failed',
    //             'message'       => $e->getMessage(),
    //             'created_at'    => now(),
    //             'updated_at'    => now(),
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan saat sinkronisasi: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }




    public function syncFromApi(Request $request)
{
    set_time_limit(300);
    ini_set('memory_limit', '512M');

    $totalRecords = 0;

    try {
        DB::beginTransaction();

        // Ambil data dari API
        $response = Http::withoutVerifying()
            ->timeout(120)
            ->get('https://1821986ae1e4.ngrok-free.app/contacts');

        $data = $response->json();

        if (!$data['success']) {
            throw new \Exception('Gagal mengambil data dari API');
        }

        $contacts = $data['data'];

        foreach ($contacts as $item) {
            $totalRecords++;

            // Helper
            $toString = fn($value) => is_array($value) ? implode(', ', $value) : $value;

            // Normalisasi contact_id
            $contactId = isset($item['contact_id']) ? (string)$item['contact_id'] : null;

            // Insert/update contact
            $contact = ContactModel::updateOrCreate(
                ['id' => $item['id']],
                [
                    'contact_id'    => $contactId,
                    'name'          => $toString($item['name'] ?? null),
                    'street'        => $toString($item['street'] ?? null),
                    'street2'       => $toString($item['street2'] ?? null),
                    'city'          => $toString($item['city'] ?? null),
                    'zip'           => $toString($item['zip'] ?? null),
                    'npwp'          => $toString($item['npwp'] ?? null),
                    'your_business' => $toString($item['your_business'] ?? null),
                    'job_position'  => $toString($item['job_position'] ?? null),
                    'phone'         => $toString($item['phone'] ?? null),
                    'mobile'        => $toString($item['mobile'] ?? null),
                    'email'         => $toString($item['email'] ?? null),
                    'website'       => $toString($item['website'] ?? null),
                    'title'         => $toString($item['title'] ?? null),
                    'language'      => $toString($item['language'] ?? null),
                    'company_type'  => $toString($item['company_type'] ?? null),
                ]
            );

            // Hapus relasi lama
            ContactCountryModel::where('contact_id', $contact->id)->delete();
            ContactStateModel::where('contact_id', $contact->id)->delete();
            ContactTagModel::where('contact_id', $contact->id)->delete();

            /*
            |-----------------------------------------------------
            | 4. SIMPAN COUNTRY (single, bukan array!)
            |-----------------------------------------------------
            */
            if (!empty($item['country_id'])) {
                ContactCountryModel::create([
                    'contact_id'   => $contact->id,
                    'country_id'   => $item['country_id'],
                    'country_name' => $item['country_name'] ?? null,
                ]);
            }

            /*
            |-----------------------------------------------------
            | 5. SIMPAN STATE (single, bukan array!)
            |-----------------------------------------------------
            */
            if (!empty($item['state_id'])) {
                ContactStateModel::create([
                    'contact_id' => $contact->id,
                    'state_id'   => $item['state_id'],
                    'state_name' => $item['state_name'] ?? null,
                ]);
            }

            /*
            |-----------------------------------------------------
            | 6. SIMPAN TAGS (jika API menyediakan)
            | API kamu belum kirim tags → otomatis skip
            |-----------------------------------------------------
            */
            if (!empty($item['tags']) && is_array($item['tags'])) {
                foreach ($item['tags'] as $tag) {
                    ContactTagModel::create([
                        'contact_id' => $contact->id,
                        'tag_id'     => $tag['id'] ?? null,
                        'tag_name'   => $tag['name'] ?? null,
                    ]);
                }
            }
        }

        DB::commit();

        // Simpan Log
        DB::table('contact_sync_logs')->insert([
            'sync_time'     => now(),
            'total_records' => $totalRecords,
            'status'        => 'success',
            'message'       => "Sinkronisasi berhasil. Total data: {$totalRecords}",
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        if (!$request->ajax()) {
            return redirect()
                ->route('Admin.quotation.system.contact.sync')
                ->with('success', 'Sinkronisasi data kontak berhasil!');
        }

        return response()->json([
            'success' => true,
            'message' => 'Sinkronisasi data kontak berhasil!',
            'total_records' => $totalRecords
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        DB::table('contact_sync_logs')->insert([
            'sync_time'     => now(),
            'total_records' => $totalRecords,
            'status'        => 'failed',
            'message'       => $e->getMessage(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat sinkronisasi: ' . $e->getMessage()
        ], 500);
    }
}

}

    

    

