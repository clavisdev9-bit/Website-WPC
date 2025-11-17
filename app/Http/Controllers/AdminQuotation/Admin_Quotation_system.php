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
             'title' => 'List Request Quotation',
        ];
        return view('admin-quotation/list-request-quotation/datatable/file', $data);
   }


  public function Get_Quotations(Request $request)
{
   
    if ($request->ajax()) {
         $data = Cache::remember('quotations_data', 60, function () {
            $response = Http::withoutVerifying()->get('https://0e3242f7df3f.ngrok-free.app/quotes');

            if (!$response->successful()) {
                return []; // Kalau gagal, return kosong
            }

            $result = $response->json();
            return $result['data'] ?? [];
        });


        // === . Ambil & Cache Lookup Commodity ===
        $commodities = Cache::remember('commodities_lookup', 60, function () {
            $res = Http::withoutVerifying()->get('https://0e3242f7df3f.ngrok-free.app/lookups/commodities');

            if (!$res->successful()) return [];

            $data = $res->json()['data'] ?? [];

            // id => name
            return collect($data)->pluck('name', 'id')->toArray();
        });

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('code_quotation', function ($row) {
                return $row['name'] ?? '-';
            })
            ->addColumn('date_request', function ($row) {
                return \Carbon\Carbon::parse($row['create_date'])->format('d M Y');
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
                    ->rawColumns(['transportation_method'])
                    
                    ->addColumn('data_quotation', function ($row) use ($commodities) {

                // Pickup origin
                $Pickuporigin = $row['pickup_origin'] ?? [null, null];
                $originName = $Pickuporigin[1] ?? '';

                // Destination
                $destinationPickup = $row['pickup_destination'] ?? [null, null];
                $destinationName = $destinationPickup[1] ?? '';

                // Commodity (konversi ID → nama)
                $commodityName = $commodities[$row['commodity']] ?? $row['commodity'] ?? '-';

                return '<button type="button" class="btn btn-outline-primary" id="quotation"
                    data-bs-toggle="modal" data-bs-target="#modal-quotation"
                    data-terms="' . e($row['terms_condition']) . '"
                    data-commodity="' . e($commodityName) . '"
                    data-uom="' . e($row['uom']) . '"
                    data-ratio="' . e($row['ratio']) . '"
                    data-kgs_chg="' . e($row['kgs_chg']) . '"
                    data-kgs_wt="' . e($row['kgs_wt']) . '"
                    data-qty="' . e($row['qty']) . '"
                    data-no_request="' . e($row['name']) . '"
                    data-pickup_origin="' . e($originName) . '"
                    data-destination_origin="' . e($destinationName) . '"
                    data-transportation_method="' . e($row['transportation_method']) . '">
                        <i class="fas fa fa-file"></i> Quotation Request
                </button>';
            })

 
                    // ->addColumn('data_quotation', function ($row) {
                    //        $Pickuporigin = $row['pickup_origin'] ?? null;
                    //         $originId = $Pickuporigin[0] ?? '';
                    //         $originName = $Pickuporigin[1] ?? '';

                    //         $destinationPickup = $row['pickup_destination'] ?? null;
                    //         $destinationId = $destinationPickup[0] ?? '';
                    //         $destinationName = $destinationPickup[1] ?? '';

                    //     return '<button type="button" 
                    //                 class="btn btn-outline-primary"
                    //                 id="quotation"
                    //                 data-bs-toggle="modal" 
                    //                 data-bs-target="#modal-quotation"
                    //                 data-terms="' . e($row['terms_condition']) . '"
                    //                 data-commodity="' . e($row['commodity']) . '"
                    //                 data-uom="' . e($row['uom']) . '"
                    //                 data-ratio="' . e($row['ratio']) . '"
                    //                 data-kgs_chg="' . e($row['kgs_chg']) . '"
                    //                 data-kgs_wt="' . e($row['kgs_wt']) . '"
                    //                 data-qty="' . e($row['qty']) . '"
                    //                 data-no_request="' . e($row['name']) . '"
                    //                 data-pickup_origin="' . e($originName) . '"
                    //                 data-destination_origin="' . e($destinationName) . '"
                    //                 data-transportation_method="' . e($row['transportation_method']) . '"
                    //                 >
                    //                 <i class="fas fa fa-file"> </i> Quotation Request
                    //             </button>';
                    // })


                    ->addColumn('agents_pickup', function ($row) {
                            $Pickuporigin = $row['pickup_origin'] ?? null;
                            $originName = $Pickuporigin[1] ?? '';
                            $methodPickup = strtolower($row['transportation_method'] ?? '');
                            $codeRequest = $row['name'] ?? '';
                       
                        return '<button type="button" 
                                    class="btn btn-outline-primary"
                                    id="pickup"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-pickup-agent"
                                    data-pickup_origin_s="' . e($originName) . '"
                                    data-code_req="' . $codeRequest . '"
                                    data-tm="' . $methodPickup . '"
                                    data-terms-condition-pick="' . e($row['terms_condition']) . '"
                                    >
                                    <i class="fa-solid fa-box-open"> </i> Pickup Agent
                                </button>';
                    })

                    ->addColumn('agents_destination', function ($row) {
                            $Destinationorigin = $row['pickup_destination'] ?? null;
                            $originNameDestination = $Destinationorigin[1] ?? '';
                            $methodDestination = strtolower($row['transportation_method'] ?? '');
                            $codeRequestDestination = $row['name'] ?? '';
                       
                        return '<button type="button" 
                                    class="btn btn-outline-warning"
                                    id="destination"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-destination-agent"
                                    data-destination_origin_s="' . e($originNameDestination) . '"
                                    data-code_req_destination="' . $codeRequestDestination . '"
                                    data-dm="' . $methodDestination . '"
                                    data-terms-condition-dest="' . e($row['terms_condition']) . '"
                                    >
                                   <i class="fa-solid fa-warehouse"></i> Destination Agent
                                </button>';
                    })
                    ->rawColumns(['data_customer','data_quotation','transportation_method','agents_pickup','agents_destination'])
                    ->make(true);
    }
}
 // end code ambil data request list quotation







































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
                return '<a id="sets" class="btn btn-pill btn-outline-orange btn-sm" data-bs-toggle="modal" data-bs-target="#modal-large"
                             data-name="' . htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8') . '"
                             data-email="' . htmlspecialchars($row->email, ENT_QUOTES, 'UTF-8') . '"
                             data-phone="' . htmlspecialchars($row->phone, ENT_QUOTES, 'UTF-8') . '"
                             data-country-name="' . htmlspecialchars($row->countries->pluck('country_name'), ENT_QUOTES, 'UTF-8') . '"
                             data-state-name="' . htmlspecialchars($row->states->pluck('state_name'), ENT_QUOTES, 'UTF-8') . '"
                             data-street-name="' . htmlspecialchars($row->street, ENT_QUOTES, 'UTF-8') . '"
                             data-street-two-name="' . htmlspecialchars($row->street2, ENT_QUOTES, 'UTF-8') . '"
                             data-zip-name="' . htmlspecialchars($row->zip, ENT_QUOTES, 'UTF-8') . '"
                             >
                            <i class="fa fa-sticky-note"> </i> Details
                        </a>';
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
