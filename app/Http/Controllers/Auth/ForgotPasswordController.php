<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // 🔴 CEK EMAIL TERDAFTAR ATAU TIDAK
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar di sistem.'
            ]);
        }

        // ✅ Kirim link reset
        Password::sendResetLink(
            $request->only('email')
        );

        // Redirect aman (hindari loop)
        return redirect()->route('login')
            ->with('success', 'Link reset password telah dikirim ke email Anda.');
    }
}
