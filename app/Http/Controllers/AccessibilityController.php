<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccessibilitySetting;

class AccessibilityController extends Controller
{
    /**
     * Simpan pengaturan aksesibilitas user
     */
    public function saveSettings(Request $request)
    {
        $validated = $request->validate([
            'font_size' => 'required|in:small,medium,large,extra-large',
            'contrast_mode' => 'required|in:normal,high,dark',
            'dyslexia_font' => 'required|boolean',
            'screen_reader_mode' => 'required|boolean',
            'keyboard_navigation' => 'required|boolean',
        ]);

        // Simpan ke session untuk guest user
        session([
            'accessibility' => $validated
        ]);

        // Jika user login, simpan ke database
        if (Auth::check()) {
            UserAccessibilitySetting::updateOrCreate(
                ['user_id' => Auth::id()],
                $validated
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan aksesibilitas berhasil disimpan'
        ]);
    }

    /**
     * Ambil pengaturan aksesibilitas user
     */
    public function getSettings()
    {
        // Default settings
        $defaults = [
            'font_size' => 'medium',
            'contrast_mode' => 'normal',
            'dyslexia_font' => false,
            'screen_reader_mode' => false,
            'keyboard_navigation' => true,
        ];

        // Cek dari database jika user login
        if (Auth::check()) {
            $settings = UserAccessibilitySetting::where('user_id', Auth::id())->first();
            if ($settings) {
                return response()->json($settings->toArray());
            }
        }

        // Jika tidak ada di database, cek session
        $sessionSettings = session('accessibility', $defaults);
        
        return response()->json($sessionSettings);
    }

    /**
     * Reset pengaturan aksesibilitas
     */
    public function resetSettings()
    {
        session()->forget('accessibility');

        if (Auth::check()) {
            UserAccessibilitySetting::where('user_id', Auth::id())->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan aksesibilitas direset'
        ]);
    }
}