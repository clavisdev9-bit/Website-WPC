<?php

namespace App\Http\Controllers\Api\ApiInternal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Mime\Part\TextPart;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\AlternativePart;

class SendEmail extends Controller
{



//    public function sendOfferEmailPickup(Request $request)
// {
//     $request->validate([
//         'subject' => 'required|string',
//         'message' => 'required|string',
//         // 'contacts' tidak perlu string, cukup pastikan ada datanya
//         'contacts' => 'required', 
//         // 'cc' akan kita handle sebagai string JSON, jadi string sudah benar
//         'cc' => 'nullable|string', 
//         'attachment' => 'nullable|file|max:10240', // 10MB max
//     ]);

//     // 1. DECODE KONTAK (Penerima utama TO)
//     $contacts = json_decode($request->contacts, true);
//     $emails = collect($contacts)->pluck('email')->filter()->toArray();

//     // 2. DECODE CC DENGAN BENAR DARI JSON
//     // Pastikan nilai 'cc' tidak kosong sebelum di-decode
//     $ccJson = $request->cc;
//     $ccArray = [];
//     if (!empty($ccJson)) {
//         // $ccJson akan berisi string JSON seperti '["email1@a.com"]' atau '[]'
//         $ccArray = json_decode($ccJson, true); 
        
//         // Filter untuk memastikan hasil decode adalah array dan elemennya tidak kosong
//         if (is_array($ccArray)) {
//              $ccArray = collect($ccArray)->filter()->toArray();
//         } else {
//              $ccArray = []; // Jika decode gagal, set ke array kosong
//         }
//     }
    
//     // Periksa jika list CC mengandung alamat email, dan buang jika kosong
//     $ccList = !empty($ccArray) ? $ccArray : []; 


//     if (empty($emails)) {
//         return response()->json(['success' => false, 'message' => 'No valid recipient emails found.'], 400); // Gunakan kode status 400
//     }

//     // --- LOGIKA PENGIRIMAN EMAIL ---
//     try {
//         Mail::send([], [], function ($message) use ($request, $emails, $ccList) {
            
//             // Set Penerima TO
//             $message->to($emails)
//                     ->subject($request->subject);

//             // Set CC HANYA jika list tidak kosong
//             if (!empty($ccList)) {
//                 $message->cc($ccList);
//             }

//             // Set Isi Pesan
//             // Ganti ini: $message->setBody(new TextPart($request->message, 'utf-8', 'html'));
//             // Dengan ini (lebih standar Laravel untuk body HTML sederhana):
//             $message->html($request->message); 
            
//             // Atau jika ingin menggunakan format teks biasa (plain text):
//             // $message->text($request->message); 

//             // Tambah attachment
//             if ($request->hasFile('attachment')) {
//                 $message->attach(
//                     $request->file('attachment')->getRealPath(),
//                     [
//                         'as' => $request->file('attachment')->getClientOriginalName(),
//                         'mime' => $request->file('attachment')->getMimeType(),
//                     ]
//                 );
//             }
//         });

//         return response()->json(['success' => true, 'message' => 'Email sent successfully']);

//     } catch (\Exception $e) {
//         // Tangkap error pengiriman dan kembalikan pesan yang jelas
//         \Log::error('Email Send Error: ' . $e->getMessage(), ['exception' => $e]);
//         return response()->json([
//             'success' => false, 
//             'message' => 'Failed to send email. Error: ' . $e->getMessage()
//         ], 500); // Gunakan kode status 500 untuk error server
//     }
// }



// public function sendOfferEmailPickup(Request $request)
// {
//     $request->validate([
//         'subject' => 'required|string',
//         'message' => 'required|string',
//         'contacts' => 'required',
//         'cc' => 'nullable|string',
//         'attachment' => 'nullable|file|max:10240',
//     ]);

//     // 1. Ambil email tujuan
//     $contacts = json_decode($request->contacts, true);
//     $emails = collect($contacts)->pluck('email')->filter()->toArray();

//     // 2. CC
//     $ccArray = [];
//     if (!empty($request->cc)) {
//         $decoded = json_decode($request->cc, true);
//         $ccArray = is_array($decoded) ? array_filter($decoded) : [];
//     }

//     if (empty($emails)) {
//         return response()->json(['success' => false, 'message' => 'No valid recipient emails found.'], 400);
//     }

//     try {
//         Mail::send([], [], function ($message) use ($request, $emails, $ccArray) {
//             $message->to($emails)
//                     ->subject($request->subject);

//             if (!empty($ccArray)) {
//                 $message->cc($ccArray);
//             }

//             // 💡 Format message jadi HTML rapi
//             $body = nl2br(e($request->message)); // ubah newline ke <br>, escape HTML jahat

//             // Tambah styling HTML agar tampil proper di email client
//             $htmlBody = '
//                 <div style="font-family: Arial, sans-serif; color: #222; font-size: 14px; line-height: 1.6;">
//                     <p>' . str_replace("\n", '<br>', $body) . '</p>
//                 </div>
//             ';

//             $message->html($htmlBody);

//             // Attach file kalau ada
//             if ($request->hasFile('attachment')) {
//                 $message->attach(
//                     $request->file('attachment')->getRealPath(),
//                     [
//                         'as' => $request->file('attachment')->getClientOriginalName(),
//                         'mime' => $request->file('attachment')->getMimeType(),
//                     ]
//                 );
//             }
//         });

//         return response()->json(['success' => true, 'message' => 'Email sent successfully']);
//     } catch (\Exception $e) {
//         \Log::error('Email Send Error: ' . $e->getMessage(), ['exception' => $e]);
//         return response()->json([
//             'success' => false,
//             'message' => 'Failed to send email. Error: ' . $e->getMessage(),
//         ], 500);
//     }
// }



// public function sendOfferEmailPickup(Request $request)
// {
//     $request->validate([
//         'subject' => 'required|string',
//         'message' => 'required|string',
//         'contacts' => 'required',
//         'cc' => 'nullable|string',
//         'attachment' => 'nullable|file|max:10240',
//     ]);

//     // Decode kontak utama
//     $contacts = json_decode($request->contacts, true);
//     $emails = collect($contacts)->pluck('email')->filter()->toArray();

//     // Decode CC
//     $ccArray = [];
//     if (!empty($request->cc)) {
//         $decoded = json_decode($request->cc, true);
//         $ccArray = is_array($decoded) ? array_filter($decoded) : [];
//     }

//     if (empty($emails)) {
//         return response()->json(['success' => false, 'message' => 'No valid recipient emails found.'], 400);
//     }

//     try {
//         Mail::send([], [], function ($message) use ($request, $emails, $ccArray) {
//             $message->to($emails)
//                     ->subject($request->subject);

//             if (!empty($ccArray)) {
//                 $message->cc($ccArray);
//             }

//             // Konversi message dari user
//             $body = nl2br(e($request->message)); // aman dan ubah newline ke <br>

//             // 💎 HTML Email Template
//             $htmlBody = '
//             <div style="font-family: Arial, sans-serif; background-color:#f5f7fa; padding:30px;">
//               <div style="max-width:600px; margin:0 auto; background:#ffffff; border-radius:10px; box-shadow:0 0 8px rgba(0,0,0,0.08); overflow:hidden;">
                
//                 <!-- HEADER -->
//                 <div style="background-color:#003366; padding:20px; text-align:center;">
//                     <img src="https://wpc-logistics.co.id/logo.png" alt="WPC Logistics" style="height:50px;">
//                     <h2 style="color:#ffffff; margin-top:10px; font-weight:normal;">WPC LOGISTICS SYSTEM</h2>
//                 </div>

//                 <!-- BODY -->
//                 <div style="padding:30px; color:#333333; font-size:14px; line-height:1.7;">
//                     <p>' . $body . '</p>
//                 </div>

//                 <!-- FOOTER -->
//                 <div style="background-color:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#555;">
//                     © ' . date('Y') . ' WPC Logistics | <a href="https://wpc-logistics.co.id" style="color:#003366; text-decoration:none;">wpc-logistics.co.id</a><br>
//                     System Generated Email — Please do not reply directly.
//                 </div>
//               </div>
//             </div>
//             ';

//             $message->html($htmlBody);

//             // Lampiran
//             if ($request->hasFile('attachment')) {
//                 $message->attach(
//                     $request->file('attachment')->getRealPath(),
//                     [
//                         'as' => $request->file('attachment')->getClientOriginalName(),
//                         'mime' => $request->file('attachment')->getMimeType(),
//                     ]
//                 );
//             }
//         });

//         return response()->json(['success' => true, 'message' => 'Email sent successfully']);
//     } catch (\Exception $e) {
//         \Log::error('Email Send Error: ' . $e->getMessage(), ['exception' => $e]);
//         return response()->json([
//             'success' => false,
//             'message' => 'Failed to send email. Error: ' . $e->getMessage()
//         ], 500);
//     }
// }


public function sendOfferEmailPickup(Request $request)
{
    $request->validate([
        'subject' => 'required|string',
        'message' => 'required|string',
        'contacts' => 'required',
        'cc' => 'nullable|string',
        'attachment' => 'nullable|file|max:10240', // max 10MB
    ]);

    // Decode kontak utama (To:)
    $contacts = json_decode($request->contacts, true);
    $emails = collect($contacts)->pluck('email')->filter()->toArray();

    // Decode CC (jika ada)
    $ccArray = [];
    if (!empty($request->cc)) {
        $decoded = json_decode($request->cc, true);
        $ccArray = is_array($decoded) ? array_filter($decoded) : [];
    }

    if (empty($emails)) {
        return response()->json(['success' => false, 'message' => 'No valid recipient emails found.'], 400);
    }

    try {
    Mail::send([], [], function ($message) use ($request, $emails, $ccArray) {
        $message->to($emails)
                ->subject($request->subject);

        if (!empty($ccArray)) {
            $message->cc($ccArray);
        }

        // Konversi pesan dari user
        $body = nl2br(e($request->message));

        // Ambil logo dari public path
        $logoPath = public_path('images/logo.png'); // contoh: public/images/logo.png
        $logoCid = null;
        if (file_exists($logoPath)) {
            $logoCid = $message->embed($logoPath);
        } else {
            // fallback online jika logo lokal tidak ada
            $logoCid = 'https://wpc-logistics.co.id/logo.png';
        }

        // Template email modern
        $htmlBody = '
        <div style="font-family:Arial,Helvetica,sans-serif; background-color:#f5f6fa; padding:30px;">
          <div style="max-width:640px; margin:auto; background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
            
            <!-- HEADER -->
            <div style="background-color:#003366; text-align:center; padding:25px 20px;">
                <img src="' . $logoCid . '" alt="WPC Logistics" style="max-width:140px; height:auto; display:inline-block; margin-bottom:10px;">
            </div>

            <!-- BODY -->
            <div style="padding:35px 40px; color:#333; font-size:14px; line-height:1.7;">
                <p>' . $body . '</p>
            </div>

            <div style="padding:35px 40px; color:#333; font-size:14px; line-height:1.7;">
               <p>Press the button below if you want to see the detailed list of quotations</p>
            </div>

            <div style="margin:30px 0;">
            <table border="0" cellspacing="0" cellpadding="0" align="left">
                <tr>
                <td bgcolor="#004aad" style="border-radius:6px;">
                    <a href="https://edu-wpc.odoo.com/my/" target="_blank"
                    style="display:inline-block; padding:12px 28px; font-family:Arial,Helvetica,sans-serif;
                    font-size:14px; color:#ffffff; text-decoration:none; font-weight:bold;">
                    View Quotation Online
                    </a>
                </td>
                </tr>
            </table>
            </div>

            <div style="padding:35px 40px; color:#333; font-size:14px; line-height:1.7;">
               <br><br>
            </div>

            <div style="padding:35px 40px; color:#333; font-size:14px; line-height:1.7;">
                <p>Best Regards,<br><br><br>
                WPC Logistics Team</p>
            </div>

            <!-- FOOTER -->
            <div style="background:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#555;">
                © ' . date('Y') . ' WPC Logistics |
                <a href="https://wpc-logistics.co.id" style="color:#003366; text-decoration:none;">wpc-logistics.co.id</a><br>
                <span style="color:#999;"> Email Generated BY System — Please do not reply directly.</span>
            </div>

          </div>
        </div>';

        $message->html($htmlBody);

        // Lampiran (jika ada)
        if ($request->hasFile('attachment')) {
            $message->attach(
                $request->file('attachment')->getRealPath(),
                [
                    'as' => $request->file('attachment')->getClientOriginalName(),
                    'mime' => $request->file('attachment')->getMimeType(),
                ]
            );
        }
    });

    return response()->json(['success' => true, 'message' => 'Email sent successfully']);
} catch (\Exception $e) {
    \Log::error('Email Send Error: ' . $e->getMessage(), ['exception' => $e]);
    return response()->json([
        'success' => false,
        'message' => 'Failed to send email. Error: ' . $e->getMessage()
    ], 500);
}


    // try {
    //     Mail::send([], [], function ($message) use ($request, $emails, $ccArray) {
    //         $message->to($emails)
    //                 ->subject($request->subject);

    //         if (!empty($ccArray)) {
    //             $message->cc($ccArray);
    //         }

    //         // Gunakan logo dari folder public/images/logo.png
    //         $logoPath = public_path('images/logox.png');
    //         $logoCid = null;
    //         if (file_exists($logoPath)) {
    //             $logoCid = $message->embed($logoPath);
    //         }

    //         // Ubah newline jadi <br> tapi tetap aman
    //         $body = nl2br(e($request->message));

    //         // 💎 Email Template HTML
    //         $htmlBody = '
    //         <div style="font-family: Arial, sans-serif; background-color:#f5f7fa; padding:30px;">
    //           <div style="max-width:600px; margin:0 auto; background:#ffffff; border-radius:10px; box-shadow:0 0 8px rgba(0,0,0,0.08); overflow:hidden;">
                
    //            <!-- HEADER -->
    //             <div style="background-color:#003366; padding:20px; text-align:center;">
    //                 ' . ($logoCid ? '
    //                     <img src="' . $logoCid . '" alt="WPC Logistics" 
    //                         style="max-height:40px; width:auto; margin-bottom:8px; display:inline-block;">
    //                 ' : '') . '
    //                 <h2 style="color:#ffffff; margin:0; font-size:18px; font-weight:600; letter-spacing:1px;">
    //                     WPC LOGISTICS SYSTEM
    //                 </h2>
    //             </div>


    //             <!-- BODY -->
    //             <div style="padding:30px; color:#333333; font-size:14px; line-height:1.7;">
    //                 <p>' . $body . '</p>
    //             </div>

    //             <!-- FOOTER -->
    //             <div style="background-color:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#555;">
    //                 © ' . date('Y') . ' WPC Logistics | 
    //                 <a href="https://wpc-logistics.co.id" style="color:#003366; text-decoration:none;">wpc-logistics.co.id</a><br>
    //                 System Generated Email — Please do not reply directly.
    //             </div>
    //           </div>
    //         </div>
    //         ';

    //         $message->html($htmlBody);

    //         // Lampiran (jika ada)
    //         if ($request->hasFile('attachment')) {
    //             $message->attach(
    //                 $request->file('attachment')->getRealPath(),
    //                 [
    //                     'as' => $request->file('attachment')->getClientOriginalName(),
    //                     'mime' => $request->file('attachment')->getMimeType(),
    //                 ]
    //             );
    //         }
    //     });

    //     return response()->json(['success' => true, 'message' => 'Email sent successfully']);
    // } catch (\Exception $e) {
    //     \Log::error('Email Send Error: ' . $e->getMessage(), ['exception' => $e]);
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Failed to send email. Error: ' . $e->getMessage()
    //     ], 500);
    // }
}

}