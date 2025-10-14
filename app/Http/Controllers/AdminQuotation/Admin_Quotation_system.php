<?php

namespace App\Http\Controllers\AdminQuotation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Cache;
use App\Models\ContactModel;
use App\Models\ContactSyncLogModel;
use App\Models\ContactTagModel;


class Admin_Quotation_system extends Controller
{
    protected $ContactModel;
    protected $ContactSyncLogModel;
    protected $ContactTagModel;
    public function __construct(ContactModel $ContactModel, ContactSyncLogModel $ContactSyncLogModel, ContactTagModel $ContactTagModel) {
        $this->ContactModel = $ContactModel;
        $this->ContactSyncLogModel = $ContactSyncLogModel;
        $this->ContactTagModel = $ContactTagModel;
    }


    // code untuk home admin quotation
    public function Home()  {
          $data = [
           'title' => 'Home Request Quotation'
          ];
            return view('admin-quotation/home/file', $data);
    }


    // start code ambil data request list quotation
   public function List_Request_Quotation()  {
        $data = [
             'title' => 'List Request Quotation'
        ];
        return view('admin-quotation/list-request-quotation/datatable/file', $data);
   }


  public function Get_Quotations(Request $request)
{
   
    if ($request->ajax()) {
        // Ambil data API
        $response = Http::withoutVerifying()->get('https://discomposingly-grainless-dante.ngrok-free.app/quotes');
        $result = $response->json();

        $data = $result['data'] ?? [];

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('code_quotation', function ($row) {
                return $row['name'] ?? '-';
            })
            ->addColumn('date_request', function ($row) {
                return \Carbon\Carbon::parse($row['create_date'])->format('d M Y H:i');
            })
            ->addColumn('data_customer', function ($row) {
                        $customer = $row['customer'] ?? null;
                        if (!$customer) return '-';
                        return '<button type="button" 
                                    class="btn btn-outline-primary"
                                    id="sets"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-costumers-quotation"
                                    data-name_cust="' . e($customer['name']) . '"
                                    data-email="' . e($customer['email']) . '"
                                    data-phone="' . e($customer['phone']) . '"
                                    data-state_code="' . e($customer['state_code']) . '"
                                    data-state="' . e($customer['state']) . '"
                                    data-no_reg="' . e($row['name']) . '"
                                >
                                <i class="fas fa fa-users"> </i> Data Customer
                                </button>';
                    })

                 ->addColumn('transportation_method', function ($row) {
                        $method = strtolower($row['transportation_method'] ?? '');

                        switch ($method) {
                            case 'air':
                                return '<i class="fa fa-plane text-primary"></i> Air';
                            case 'ocean':
                                return '<i class="fa fa-ship text-info"></i> Ocean';
                            case 'air & ocean':
                                return '<i class="fa fa-plane text-primary"></i> &nbsp; <i class="fa fa-ship text-info"></i> Air & Ocean';
                            case 'domestic ground transportation':
                                return '<i class="fa fa-truck text-success"></i> Domestic Ground';
                            default:
                                return '<span class="text-muted">-</span>';
                        }
                    })
                    ->rawColumns(['transportation_method']) // penting supaya HTML tidak di-escape

 
                    ->addColumn('data_quotation', function ($row) {
                           $Pickuporigin = $row['pickup_origin'] ?? null;
                            $originId = $Pickuporigin[0] ?? '';
                            $originName = $Pickuporigin[1] ?? '';


                            $destinationPickup = $row['pickup_destination'] ?? null;
                            $destinationId = $destinationPickup[0] ?? '';
                            $destinationName = $destinationPickup[1] ?? '';

                        return '<button type="button" 
                                    class="btn btn-outline-primary"
                                    id="quotation"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-quotation"
                                    data-terms="' . e($row['terms_condition']) . '"
                                    data-no_request="' . e($row['name']) . '"
                                    data-pickup_origin="' . e($originName) . '"
                                    data-destination_origin="' . e($destinationName) . '"
                                    data-transportation_method="' . e($row['transportation_method']) . '"
                                    >
                                    <i class="fas fa fa-file"> </i> Data Quotation Request
                                </button>';
                    })

                    ->addColumn('agents_pickup', function ($row) {
                        $origin = $row['pickup_origin'][1] ?? '-';
                        return '<button type="button" 
                                    class="btn btn-outline-primary"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-agent-searching-origin"
                                    data-origin="' . e($origin) . '">
                                    <i class="fa fa-search"> </i> Agent Pickup
                                </button>';
                    })


                    ->addColumn('agents_destination', function ($row) {
                        $destination = $row['pickup_destination'][1] ?? '-';
                        return '<button type="button" 
                                    class="btn btn-outline-warning"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-agent-searching-destination"
                                    data-destination="' . e($destination) . '">
                                    <i class="fa fa-search"> </i> Agent Destination
                                </button>';
                    })
            ->rawColumns(['data_customer','data_quotation','transportation_method','agents_pickup','agents_destination'])
            ->make(true);
    }
}
 // end code ambil data request list quotation



  // ambil list countries dari API eksternal
   public function countries()
    {
        try {
        // Simpan cache 1 jam (3600 detik)
        $countries = Cache::remember('countries', 3600, function () {
            $response = Http::withOptions(['verify' => false]) // disable SSL kalau perlu
                ->get('https://discomposingly-grainless-dante.ngrok-free.app/countries');

            if ($response->successful()) {
                return $response->json();
            }

            return null;
        });

        if ($countries) {
            return response()->json([
                'success' => true,
                'data'    => $countries['data'] ?? [],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch countries from API',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Server error: ' . $e->getMessage(),
        ]);
    }
    }



    //ambil states berdasarkan country_id
  public function states($country_id)
{
    try {
        // Cache per country id, simpan 1 jam (3600 detik)
        $cacheKey = "states_{$country_id}";

        $states = Cache::remember($cacheKey, 3600, function () use ($country_id) {
            $response = Http::withOptions(['verify' => false])
                ->get("https://discomposingly-grainless-dante.ngrok-free.app/states/country/{$country_id}");

            if ($response->successful()) {
                return $response->json();
            }
            return null;
        });

        if ($states) {
            return response()->json([
                'success' => true,
                'data'    => $states['data'] ?? [],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch states from API',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Server error: ' . $e->getMessage(),
        ]);
    }

}



public function getContactCities()
{
    try {
        $cities = $this->ContactModel
            ->whereNotNull('city')
            ->pluck('city')
            ->filter(function ($city) {
                // Hapus spasi di awal/akhir dan buang yang kosong
                return trim($city) !== '';
            })
            ->unique()
            ->values();

        if ($cities->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No cities found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $cities
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}


public function getContactStreets()
{
    try {
        $streets = $this->ContactModel
            ->whereNotNull('street')
            ->pluck('street')
            ->filter(function ($street) {
                // Hilangkan spasi dan kosongkan nilai yang tidak valid
                return trim($street) !== '';
            })
            ->unique()
            ->values();

        if ($streets->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No streets found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $streets
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}



public function getContactZips()
{
    try {
        $zips = $this->ContactModel
            ->whereNotNull('zip')
            ->pluck('zip')
            ->filter(function ($zip) {
                return trim($zip) !== '';
            })
            ->unique()
            ->values();

        if ($zips->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No ZIP numbers found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $zips
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}




public function getContactTags()
{
    try {
        $tags = $this->ContactTagModel
            ->whereNotNull('tag_name')
            ->pluck('tag_name')
            ->filter(function ($tags) {
                return trim($tags) !== '';
            })
            ->unique()
            ->values();

        if ($tags->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No Tag Name found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tags
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}




// public function search_contact_agent(Request $request)
// {
//     try {
//         $query = $this->ContactModel->query();

//         // 🔍 Filter dinamis hanya jika field diisi
//         if ($request->filled('city')) {
//             $query->where('city', 'ILIKE', "%{$request->city}%");
//         }

//         if ($request->filled('street')) {
//             $query->where('street', 'ILIKE', "%{$request->street}%");
//         }

//         if ($request->filled('zip')) {
//             $query->where('zip', 'ILIKE', "%{$request->zip}%");
//         }

//         if ($request->filled('company_type')) {
//             $query->where('company_type', 'ILIKE', "%{$request->company_type}%");
//         }

//         // if ($request->filled('tags')) {
//         //     $query->where('tags', 'ILIKE', "%{$request->tags}%");
//         // }

//         // Ambil hasil (maksimal 50 agar ringan)
//         $contacts = $query->select([
//             'id',
//             'name',
//             'email',
//             'phone',
//             'city',
//             'street',
//             'zip',
//             'company_type'
//         ])
//         ->orderBy('name', 'asc')
//         ->limit(50)
//         ->get();

//         // Response sukses
//         return response()->json([
//             'success' => true,
//             'data' => $contacts
//         ]);
//     } catch (\Throwable $e) {
//         // Tangani error agar tetap aman
//         return response()->json([
//             'success' => false,
//             'message' => $e->getMessage()
//         ], 500);
//     }
// }



public function search_contact_agent(Request $request)
{
    try {
        $query = $this->ContactModel->query()
            ->leftJoin('contact_tags', 'contacts.id', '=', 'contact_tags.contact_id');

        // 🔍 Filter dinamis hanya jika field diisi
        if ($request->filled('city')) {
            $query->where('contacts.city', 'ILIKE', "%{$request->city}%");
        }

        if ($request->filled('street')) {
            $query->where('contacts.street', 'ILIKE', "%{$request->street}%");
        }

        if ($request->filled('zip')) {
            $query->where('contacts.zip', 'ILIKE', "%{$request->zip}%");
        }

        // if ($request->filled('company_type')) {
        //     $query->where('contacts.company_type', 'ILIKE', "%{$request->company_type}%");
        // }

        if ($request->filled('tags')) {
            // Filter berdasarkan tag_id atau tag_name
            $query->where('contact_tags.tag_name', 'ILIKE', "%{$request->tags}%");
        }

        // Ambil hasil (maksimal 50 agar ringan)
        $contacts = $query->select([
            'contacts.id',
            'contacts.name',
            'contacts.email',
            'contacts.phone',
            'contacts.city',
            'contacts.street',
            'contacts.zip',
            'contacts.company_type',
            'contact_tags.tag_name'
        ])
        ->orderBy('contacts.name', 'asc')
        ->limit(50)
        ->get();

        return response()->json([
            'success' => true,
            'data' => $contacts
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}













// start code get contact fix
public function List_System_contact_sync() {

    $data = [
           'title' => 'List Contact Result Sync',
           'titles' => 'LOG Sync'
          ];
    return view('admin-quotation/contact-sync/file', $data);
}

public function Get_data_contact_fix_sync(Request $request)
{
    if ($request->ajax()) {
        // Query dasar: ambil data dari ContactModel beserta relasinya
        $query = ContactModel::with(['countries', 'states', 'tags'])
            ->orderBy('id', 'desc');
        // Filter pencarian (opsional, otomatis oleh DataTables, tapi bisa manual juga)
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('phone', 'LIKE', "%{$searchTerm}%");
        }
        // Kembalikan data dalam format DataTables
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('country', function ($row) {
                // Ambil nama negara dari relasi countries
                if ($row->countries && count($row->countries) > 0) {
                    return implode(', ', $row->countries->pluck('country_name')->toArray());
                }
                return '-';
            })
            ->addColumn('state', function ($row) {
                if ($row->states && count($row->states) > 0) {
                    return implode(', ', $row->states->pluck('state_name')->toArray());
                }
                return '-';
            })
            ->addColumn('tags', function ($row) {
                if ($row->tags && count($row->tags) > 0) {
                    return implode(', ', $row->tags->pluck('tag_name')->toArray());
                }
                return '-';
            })
            ->addColumn('details', function ($row) {
                $btn = '<a href="#" class="btn btn-outline-warning me-1">
                            <i class="fa fa-eye"></i>
                        </a>';

                return $btn;
            })
            ->rawColumns(['details'])
            ->make(true);
    }
}

    public function getLogSyncContact(Request $request)
{
    if ($request->ajax()) {
        // Mulai query tanpa get() dulu
        $query = $this->ContactSyncLogModel->orderBy('id', 'desc');
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            $query->where('status', 'LIKE', "%{$searchTerm}%");
        }
        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()
            
            ->addColumn('sync_time', function ($row) {
                if (!$row->sync_time) {
                    return '-';
                }
                \Carbon\Carbon::setLocale('id');
                return \Carbon\Carbon::parse($row->sync_time)
                    ->translatedFormat('d F Y H:i:s'); // contoh: 10 Oktober 2025 14:35:22
            })

             ->addColumn('status', function ($row) {
        $status = strtolower($row->status ?? '');
        if ($status === 'success') {
            return '<span class="badge bg-success-lt">Success</span>';
        } elseif ($status === 'failed' || $status === 'error') {
            return '<span class="badge bg-danger-lt">Failed</span>';
        } else {
            return '<span class="badge bg-secondary-lt">' . e($row->status ?? 'Unknown') . '</span>';
        }
    })

            ->addColumn('message', function ($row) {
                $msg = e($row->message ?? '');
                return '<textarea class="form-control" rows="3" readonly>' . $msg . '</textarea>';
            })
            ->rawColumns(['message'])

            ->rawColumns(['sync_time', 'message', 'status'])
            ->make(true);
    }
}


}
