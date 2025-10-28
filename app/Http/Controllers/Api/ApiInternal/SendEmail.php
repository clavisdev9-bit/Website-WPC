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
   public function sendOfferEmailPickup(Request $request)
{
    $request->validate([
        'subject' => 'required|string',
        'message' => 'required|string',
        // 'contacts' tidak perlu string, cukup pastikan ada datanya
        'contacts' => 'required', 
        // 'cc' akan kita handle sebagai string JSON, jadi string sudah benar
        'cc' => 'nullable|string', 
        'attachment' => 'nullable|file|max:10240', // 10MB max
    ]);

    // 1. DECODE KONTAK (Penerima utama TO)
    $contacts = json_decode($request->contacts, true);
    $emails = collect($contacts)->pluck('email')->filter()->toArray();

    // 2. DECODE CC DENGAN BENAR DARI JSON
    // Pastikan nilai 'cc' tidak kosong sebelum di-decode
    $ccJson = $request->cc;
    $ccArray = [];
    if (!empty($ccJson)) {
        // $ccJson akan berisi string JSON seperti '["email1@a.com"]' atau '[]'
        $ccArray = json_decode($ccJson, true); 
        
        // Filter untuk memastikan hasil decode adalah array dan elemennya tidak kosong
        if (is_array($ccArray)) {
             $ccArray = collect($ccArray)->filter()->toArray();
        } else {
             $ccArray = []; // Jika decode gagal, set ke array kosong
        }
    }
    
    // Periksa jika list CC mengandung alamat email, dan buang jika kosong
    $ccList = !empty($ccArray) ? $ccArray : []; 


    if (empty($emails)) {
        return response()->json(['success' => false, 'message' => 'No valid recipient emails found.'], 400); // Gunakan kode status 400
    }

    // --- LOGIKA PENGIRIMAN EMAIL ---
    try {
        Mail::send([], [], function ($message) use ($request, $emails, $ccList) {
            
            // Set Penerima TO
            $message->to($emails)
                    ->subject($request->subject);

            // Set CC HANYA jika list tidak kosong
            if (!empty($ccList)) {
                $message->cc($ccList);
            }

            // Set Isi Pesan
            // Ganti ini: $message->setBody(new TextPart($request->message, 'utf-8', 'html'));
            // Dengan ini (lebih standar Laravel untuk body HTML sederhana):
            $message->html($request->message); 
            
            // Atau jika ingin menggunakan format teks biasa (plain text):
            // $message->text($request->message); 

            // Tambah attachment
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
        // Tangkap error pengiriman dan kembalikan pesan yang jelas
        \Log::error('Email Send Error: ' . $e->getMessage(), ['exception' => $e]);
        return response()->json([
            'success' => false, 
            'message' => 'Failed to send email. Error: ' . $e->getMessage()
        ], 500); // Gunakan kode status 500 untuk error server
    }
}
}