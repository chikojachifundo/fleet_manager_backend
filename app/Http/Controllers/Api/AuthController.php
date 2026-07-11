<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendOTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Step 1: Validate credentials and send OTP.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        /** @var User $user */
        $user = Auth::user();

        // Generate 6-digit OTP
        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->two_factor_code = $otp;
        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();

        // Send OTP via email
        Mail::to($user->email)->send(new SendOTP($otp, $user->name));

        return response()->json([
            'message' => 'OTP sent to your email.',
            'requires_2fa' => true,
            'email' => $user->email,
        ]);
    }

    /**
     * Step 2: Verify OTP and issue token.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid request.',
            ], 401);
        }

        if (
            !$user->two_factor_code ||
            $user->two_factor_code !== $request->otp ||
            !$user->two_factor_expires_at ||
            now()->greaterThan($user->two_factor_expires_at)
        ) {
            return response()->json([
                'message' => 'Invalid or expired OTP.',
            ], 401);
        }

        // Clear OTP after successful verification
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;
        $user->save();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }
}
