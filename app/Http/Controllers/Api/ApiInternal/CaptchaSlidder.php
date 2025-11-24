<?php

namespace App\Http\Controllers\Api\ApiInternal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaptchaSlidder extends Controller
{
    // Generate Slider Captcha Secure Token
    public function generate()
    {
        $token = bin2hex(random_bytes(16)); // 32 chars
        $timestamp = time();
        $secret = config('app.key');

        // signature = HMAC(token + timestamp)
        $signature = hash_hmac('sha256', $token . $timestamp, $secret);

        return response()->json([
            "success" => true,
            "token" => $token,
            "timestamp" => $timestamp,
            "signature" => $signature,
            "expires_in" => 120 // 2 menit
        ]);
    }

    // Validate Slider Captcha
    public function verify(Request $request)
    {
        $request->validate([
            "token" => "required",
            "timestamp" => "required|integer",
            "signature" => "required",
        ]);

        $secret = config('app.key');
        $expected = hash_hmac('sha256', $request->token . $request->timestamp, $secret);

        // Signature mismatch = BOT
        if (!hash_equals($expected, $request->signature)) {
            return response()->json([
                "success" => false,
                "message" => "Invalid captcha signature"
            ], 403);
        }

        // Token expired > 2 menit
        if (time() - $request->timestamp > 120) {
            return response()->json([
                "success" => false,
                "message" => "Captcha expired"
            ], 403);
        }

        return response()->json([
            "success" => true,
            "message" => "Captcha verified"
        ]);
    }
}
