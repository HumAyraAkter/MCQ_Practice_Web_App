<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\PasswordResetCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    // Step 1: Email দিয়ে কোড রিকোয়েস্ট
    public function sendCode(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => 'এই ইমেইল দিয়ে কোনো একাউন্ট পাওয়া যায়নি।',
            ]);
        }

        $code = (string) random_int(100000, 999999);

        DB::table('password_reset_codes')->updateOrInsert(
            ['email' => $user->email],
            [
                'code' => $code,
                'expires_at' => now()->addMinutes(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $user->notify(new PasswordResetCodeNotification($code));

        return redirect()->route('password.verify', ['email' => $user->email])
            ->with('status', 'একটি ৬-সংখ্যার কোড আপনার ইমেইলে পাঠানো হয়েছে।');
    }

    // Step 2: Code + New password ফর্ম দেখানো
    public function showVerifyForm(Request $request): View
    {
        return view('auth.verify-reset-code', ['email' => $request->query('email')]);
    }

    // Step 3: Code verify করে password reset করা
    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
            'password' => 'required|confirmed|min:8',
        ]);

        $record = DB::table('password_reset_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (! $record) {
            throw ValidationException::withMessages([
                'code' => 'কোডটি সঠিক নয়।',
            ]);
        }

        if (now()->greaterThan($record->expires_at)) {
            throw ValidationException::withMessages([
                'code' => 'কোডের মেয়াদ শেষ হয়ে গেছে। আবার রিকোয়েস্ট করুন।',
            ]);
        }

        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_codes')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে। এখন লগইন করুন।');
    }
}