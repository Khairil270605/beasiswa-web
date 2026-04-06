<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display profile page
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Update profile information
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Basic validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ];

        // Password validation (hanya jika diisi)
        if ($request->filled('current_password')) {
            $rules['current_password'] = 'required|string';
            $rules['new_password'] = 'required|string|min:8|confirmed';
        }

        // Validate request
        $validated = $request->validate($rules);

        // Update basic information
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Handle password change (jika diisi)
        if ($request->filled('current_password')) {
            // Verify current password
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Password saat ini tidak sesuai.'
                ])->withInput();
            }

            // Update password
            $user->password = Hash::make($request->new_password);
        }

        // Save changes
        $user->save();

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}