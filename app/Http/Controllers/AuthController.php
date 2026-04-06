<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // pastikan model User ada

class AuthController extends Controller
{
    // ====== LOGIN ======
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        // 👮 ADMIN
        if ($user->role === 'admin') {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login sebagai Admin');
        }

        // 🎤 PEWAWANCARA
        if ($user->role === 'pewawancara') {
            return redirect()
                ->route('pewawancara.dashboard')
                ->with('success', 'Login sebagai Pewawancara');
        }

        // 👤 USER BIASA
        return redirect()
            ->route('home')
            ->with('success', 'Login berhasil');
    }

    return back()->with('error', 'Login gagal, periksa email dan password.');
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // ====== REGISTER ======
    public function registerForm()
    {
        return view('auth.register');
    }

   public function register(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|string|email|max:255|unique:users',
        'phone'      => 'nullable|numeric|digits_between:10,15',

        // 🔐 PASSWORD KUAT
        'password'   => [
            'required',
            'string',
            'min:8',              // minimal 8 karakter
            'confirmed',          // harus sama dengan password_confirmation
            'regex:/[a-z]/',      // huruf kecil
            'regex:/[A-Z]/',      // huruf besar
            'regex:/[0-9]/',      // angka
            'regex:/[@$!%*#?&]/', // simbol
        ],
    ], [
        'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
    ]);

    User::create([
        'name'     => $request->first_name . ' ' . $request->last_name,
        'email'    => $request->email,
        'phone'    => $request->phone,
        'role'     => 'user', // 🔒 DIKUNCI
        'password' => bcrypt($request->password),
    ]);

    return redirect()
        ->route('login')
        ->with('success', 'Akun Anda berhasil dibuat, silakan login.');
}
}
