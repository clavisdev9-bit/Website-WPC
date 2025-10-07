<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Blogs;
use App\Models\CategoryModelsBlogs;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ValidationFormQuotation;
use App\Models\ContactMessage;
use App\Http\Requests\FormMessagesContactValidation;


class Users extends Controller
{
    protected $Blogs;
    protected $CategoryModelsBlogs;
    protected $ContactMessage;
    public function __construct(Blogs $Blogs, CategoryModelsBlogs $CategoryModelsBlogs, ContactMessage $ContactMessage) {
        $this->Blogs = $Blogs;
        $this->CategoryModelsBlogs = $CategoryModelsBlogs;
        $this->ContactMessage = $ContactMessage;
    }
    public function index()  {
         $query = $this->Blogs
                ->select(
                    'blogs.*',
                    'blog_categories.name as name_category',
                    'ms_users.fullname as name_author',
                )
                ->leftJoin('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
                ->leftJoin('ms_users', 'blogs.author_id', '=', 'ms_users.id_user')
                ->orderBy('blogs.created_at', 'desc')
                ->take(6) // hanya ambil 6 data terbaru
                ->get();
           $data = [
             'title' => 'Home',
             'blogs' => $query
        ];
        return view('fronts/home/file', $data);
    }

    public function about()  {
          $data = [
             'title' => 'About'
        ];
        return view('fronts/about/file', $data);
    }


    public function contact()  {
          $data = [
             'title' => 'Contact'
        ];
        return view('fronts/contact/file', $data);
    }

   public function tracking()  {
         $data = [
             'title' => 'Tracking'
        ];
        return view('fronts/tracking/file', $data);
    }

// Start code Quotation
    public function qoute()  {
        
         // Endpoint API
    $urlState = 'http://political-gerard-uncertainly.ngrok-free.app/states';

    try {
        $response = Http::timeout(10)->get($urlState);

        if ($response->successful()) {
            // Kalau API berhasil, ambil "data"
            $json = $response->json();
            $states = $json['data'] ?? [];
        } else {
            // Kalau API gagal (status 500, 404, dll)
            $states = [];
        }
    } catch (\Exception $e) {
        // Kalau timeout / error koneksi
        $states = [];
    }


     // --- Transportation Methods ---
    $urlTransport = 'http://political-gerard-uncertainly.ngrok-free.app/lookups/transportation-methods';
    $transportations = [];

    try {
        $response = Http::timeout(10)->get($urlTransport);
        if ($response->successful()) {
            $transportations = $response->json()['data'] ?? [];
        }
    } catch (\Exception $e) {
        Log::error('Transportation Methods API Error: '.$e->getMessage());
    }
         $data = [
             'title' => 'Get Qoute',
               'states' => $states,
               'transportations'=> $transportations,
        ];
        return view('fronts/qoute/file', $data);
    }

     // ambil list countries dari API eksternal
   public function countries()
    {
        $response = Http::get('http://political-gerard-uncertainly.ngrok-free.app/countries');

        if ($response->failed()) {
            return response()->json([
                "success" => false,
                "message" => "Failed to fetch countries"
            ], 500);
        }

        // ambil semua data negara dari API
        $countries = $response->json('data');

        return response()->json([
            "success" => true,
            "data" => $countries,
            "count" => count($countries)
        ]);
    }




    // contoh kalau mau ambil states berdasarkan country_id
    public function states($country_id)
    {
        $response = Http::get("http://political-gerard-uncertainly.ngrok-free.app/states/country/$country_id");

        if ($response->failed()) {
            return response()->json([
                "success" => false,
                "message" => "Failed to fetch states"
            ], 500);
        }

        $states = $response->json('data');

        return response()->json([
            "success" => true,
            "data" => $states,
            "count" => count($states)
        ]);
    }




    public function pickupOrigins(Request $request)
    {
        try {
            $response = Http::get(
                'http://political-gerard-uncertainly.ngrok-free.app/lookups/pickup-origins',
                ['transportation' => $request->transportation]
            );

            if ($response->failed()) {
                return response()->json(['data' => []], 200); // jangan 500, biar frontend tetap bisa handle
            }

            $json = $response->json();

            return response()->json([
                'data' => $json['data'] ?? []
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Pickup Origins Error: '.$e->getMessage());
            return response()->json(['data' => []], 200);
        }
    }



        public function deliveryDestination(Request $request)
        {
            try {
                $response = Http::get(
                    'http://political-gerard-uncertainly.ngrok-free.app/lookups/pickup-destinations',
                    ['transportation' => $request->transportation]
                );

                if ($response->failed()) {
                    return response()->json(['data' => []], 200);
                }

                $json = $response->json();

                return response()->json([
                    'data' => $json['data'] ?? []
                ], 200);

            } catch (\Throwable $e) {
                Log::error('Delivery Destination Error: '.$e->getMessage());
                return response()->json(['data' => []], 200);
            }
        }



        public function store_qoutation(ValidationFormQuotation $request)
        {
            try {
                // Data yang divalidasi otomatis oleh FormRequest
                $payload = [
                    "name"                   => $request->input('name'),
                    "email"                  => $request->input('email'),
                    "phone"                  => $request->input('phone'),
                    "x_studio_your_business" => $request->input('bussines_type'),
                    "state_id"               => $request->input('id'),
                    "pickup_origin_id"       => $request->input('pickup_origin'),
                    "pickup_destination_id"  => $request->input('delivery_destination'),
                    "terms_condition"        => $request->input('cargo_details'),
                    "transportation_method"  => $request->input('transportation'),
                ];

                // Kirim ke API external
                $response = Http::asJson()
                    ->post('http://political-gerard-uncertainly.ngrok-free.app/quote/create', $payload);

                if ($response->successful()) {
                    $data = $response->json();
                    return redirect()->route('users.qoute')->with('success', 'Your quotation request has been successfully submitted. Please wait for confirmation from our admin. We will contact you via email or phone. Thank you.');
                }

                if ($response->failed()) {
    // tampilkan error di layar untuk debug
    dd([
        'status' => $response->status(),
        'body'   => $response->body(),
        'payload'=> $payload, // biar tahu juga data yang kamu kirim
    ]);

    // kalau sudah fix, matikan dd() dan pakai Log lagi
    // Log::error('Quote API Error', [
    //     'status' => $response->status(),
    //     'body'   => $response->body(),
    // ]);

    return redirect()->route('users.qoute')
        ->with('error', 'Failed to create quotation, please try again or contact the telephone number provided.');
}


                // Kalau gagal, catat error response
                // Log::error('Quote API Error', [
                //     'status' => $response->status(),
                //     'body'   => $response->body(),
                // ]);
                // return redirect()->route('users.qoute')->with('error', 'Failed to create quotation, please try again or contact the telephone number provided.');
                
            } catch (\Exception $e) {
                // Tangani error (contoh: koneksi API gagal)
                Log::error('Quote Exception', ['message' => $e->getMessage()]);
                return redirect()->route('users.qoute')->with('error', 'A server error occurred. Please try again.');
            }
        }
// end code Quotation


    public function news()  {
         $query = $this->Blogs
                ->select(
                    'blogs.*',
                    'blog_categories.name as name_category',
                    'ms_users.fullname as name_author',
                )
                ->leftJoin('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
                ->leftJoin('ms_users', 'blogs.author_id', '=', 'ms_users.id_user')
                ->orderBy('blogs.created_at', 'desc')
                ->paginate(6);


         $data = [
             'title' => 'News',
              'blogs' => $query
        ];
        return view('fronts/news/file', $data);
    }


        public function news_detail($slug)  {
        
            
        $categories = CategoryModelsBlogs::withCount('blogs')->get();
        $recentPosts = Blogs::orderBy('created_at', 'desc')
            ->take(5) // ambil 5 postingan terbaru
            ->get();
        $blog =  $this->Blogs
                        ->select(
                            'blogs.*',
                            'blog_categories.name as name_category',
                            'ms_users.fullname as name_author',
                        )
                        ->leftJoin('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
                        ->leftJoin('ms_users', 'blogs.author_id', '=', 'ms_users.id_user')
                        ->where('blogs.slug', $slug)
                        ->orderBy('blogs.created_at', 'desc')
                        ->firstOrFail();

                        $prev = Blogs::where('id', '<', $blog->id)->orderBy('id','desc')->first();
                        $next = Blogs::where('id', '>', $blog->id)->orderBy('id','asc')->first();

                $data = [
                    'title' => 'News Detail',
                ];
                return view('fronts/news/file_detail', $data, compact('blog','prev','next','categories','recentPosts'));
            }




    public function network()  {
         $data = [
             'title' => 'Network'
        ];
        return view('fronts/network/file', $data);
    }


     public function logistic()  {
         $data = [
             'title' => 'Network'
        ];
        return view('fronts/services/logistic/file', $data);
    }


    public function regulation_services()  {
            $data = [
             'title' => 'Regulation Services'
        ];
        return view('fronts/services/logistic/regulation_services', $data);
    }


    public function value_added_services()  {
         $data = [
             'title' => 'Value Added Services'
        ];
        return view('fronts/services/logistic/value_added_services', $data);
    }

    public function buying_consolidation()  {
         $data = [
             'title' => 'Buying Consolidation'
        ];
        return view('fronts/services/logistic/buying_consolidation', $data);
    }


    public function warehouse_and_design()  {
         $data = [
             'title' => 'Warehouse and Design'
        ];
        return view('fronts/services/logistic/warehouse_and_design', $data);
    }


    public function inventory()  {
         $data = [
             'title' => 'Inventory'
        ];
        return view('fronts/services/logistic/inventory', $data);
    }

    
    public function rate_classification()  {
         $data = [
             'title' => 'Rate Classification'
        ];
        return view('fronts/services/logistic/rate_classification', $data);
    }


    public function vendor_management()  {
         $data = [
             'title' => 'Vendor Management'
        ];
        return view('fronts/services/logistic/vendor_management', $data);
    }

    public function freight_management()  {
         $data = [
             'title' => 'Freight Management'
        ];
        return view('fronts/services/logistic/freight_management', $data);
    }




    // start code transportation
    public function transportation()  {
          $data = [
             'title' => 'Transportation'
        ];
        return view('fronts/services/transportation/file', $data);
    }

     public function tracking_system()  {
          $data = [
             'title' => 'Tracking System'
        ];
        return view('fronts/services/transportation/tracking_system', $data);
    }



    public function consolidation_service()  {
          $data = [
             'title' => 'Consolidation Service'
        ];
        return view('fronts/services/transportation/consolidation_service', $data);
    }


    public function freight_forwarder()  {
          $data = [
             'title' => 'Freight Forwarder'
        ];
        return view('fronts/services/transportation/freight_forwarder', $data);
    }


    public function rail_service()  {
          $data = [
             'title' => 'Rail Service'
        ];
        return view('fronts/services/transportation/rail_service', $data);
    }



   public  function inter_model() {
         $data = [
             'title' => 'Inter Model'
        ];
        return view('fronts/services/transportation/inter_model', $data);
    }




    // start code Warehouse
    public function warehouse()  {
          $data = [
             'title' => 'Warehouse'
        ];
        return view('fronts/services/warehouse/file', $data);
    }

    public function dedicated_warehouse()  {
          $data = [
             'title' => 'Dedicated Warehouse'
        ];
        return view('fronts/services/warehouse/dedicated_warehouse', $data);
    }


    public function public_warehouse()  {
          $data = [
             'title' => 'Public Warehouse'
        ];
        return view('fronts/services/warehouse/public_warehouse', $data);
    }


   public function warehouse_management_system()  {
         $data = [
             'title' => 'Warehouse Management System'
        ];
        return view('fronts/services/warehouse/warehouse_management_system', $data);
    }


    
 public function new_home_qoutation() {
          $data = [
             'title' => 'Home Qoutation'
        ];
        return view('fronts/new-qoute/home', $data);
    }

    public function new_qoutation() {
          $data = [
             'title' => 'New Qoutation'
        ];
        return view('fronts/new-qoute/file', $data);
    }

    


    public function Contact_messages_store(FormMessagesContactValidation $request) {
        try {
        $this->ContactMessage->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'interested_in' => $request->input('interested_in'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'agree_privacy' => $request->input('agree_privacy'),
        ]);
        
       return redirect()->route('users.contact')->with('success','Your contact request form has been successfully submitted. We will contact you soon.');
       } catch (\Throwable $th) {
           return redirect()->route('users.contact')->with('error','Failed to create data. Please try again.');
       }
    }
}
