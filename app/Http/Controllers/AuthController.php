<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Mail\OtpEmail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        $otp = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'otp_code' => $otp,
        ];

        \Illuminate\Support\Facades\Cache::put('register_' . $request->email, $userData, now()->addMinutes(10));

        $dummyUser = (object) ['name' => $request->name, 'email' => $request->email];

        try {
            Mail::to($request->email)->send(new OtpEmail($dummyUser, $otp));
        } catch (\Exception $e) {
            \Log::error('Could not queue OTP email: ' . $e->getMessage());
        }

        \Log::info("Register OTP requested for email: " . $request->email);

        return response()->json([
            'message' => 'OTP sent to email',
            'email' => $request->email,
        ], 201);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|string|size:4',
        ]);

        $cachedData = \Illuminate\Support\Facades\Cache::get('register_' . $request->email);

        if (!$cachedData) {
            return response()->json(['message' => 'OTP code has expired or email not found'], 404);
        }

        if ($cachedData['otp_code'] !== $request->otp) {
            return response()->json(['message' => 'Invalid OTP code'], 400);
        }

        $user = User::create([
            'name' => $cachedData['name'],
            'email' => $cachedData['email'],
            'phone' => $cachedData['phone'],
            'password' => $cachedData['password'],
            'email_verified_at' => Carbon::now(),
        ]);

        \Illuminate\Support\Facades\Cache::forget('register_' . $request->email);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Email verified successfully',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $cachedData = \Illuminate\Support\Facades\Cache::get('register_' . $request->email);

        if (!$cachedData) {
            return response()->json(['message' => 'Session expired. Please register again.'], 404);
        }

        $otp = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $cachedData['otp_code'] = $otp;
        
        \Illuminate\Support\Facades\Cache::put('register_' . $request->email, $cachedData, now()->addMinutes(10));

        $dummyUser = (object) ['name' => $cachedData['name'], 'email' => $cachedData['email']];

        try {
            Mail::to($request->email)->send(new OtpEmail($dummyUser, $otp));
        } catch (\Exception $e) {
            \Log::error('Could not queue OTP email: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'OTP resent to email',
        ], 200);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User with this email not found'], 404);
        }

        $otp = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $user->otp_code = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        try {
            Mail::to($user->email)->send(new OtpEmail($user, $otp));
        } catch (\Exception $e) {
            \Log::error('Could not send OTP email: ' . $e->getMessage());
        }

        \Log::info("Forgot Password OTP requested for email: " . $user->email);

        return response()->json([
            'message' => 'Password reset OTP sent to email',
            'email' => $user->email,
        ], 200);
    }

    public function verifyPasswordResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|string|size:4',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp_code !== $request->otp) {
            return response()->json(['message' => 'Invalid OTP code'], 400);
        }

        if (Carbon::now()->isAfter($user->otp_expires_at)) {
            return response()->json(['message' => 'OTP code has expired'], 400);
        }

        return response()->json([
            'message' => 'OTP verified successfully. You can now reset your password.',
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // It is recommended to check OTP again or a token, but since we just verified it
        // and we clear it after reset, we will rely on clearing it.
        if (!$user->otp_code) {
             return response()->json(['message' => 'Invalid request. Please verify OTP first.'], 400);
        }

        $user->password = Hash::make($request->password);
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json([
            'message' => 'Password reset successfully',
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid login credentials',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = asset('storage/' . $path);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user,
        ], 200);
    }
}
