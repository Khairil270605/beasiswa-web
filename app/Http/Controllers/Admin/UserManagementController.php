<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['admin','pewawancara'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:admin,pewawancara',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
        ], [
            'password.regex' => 'Password harus mengandung huruf besar, kecil, angka, dan simbol.'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }
    public function edit($id)
{
    $user = User::findOrFail($id);

    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // ❗ admin tidak boleh mengubah role dirinya sendiri
    if (auth()->id() === $user->id && $request->role !== $user->role) {
        return back()->with('error', 'Anda tidak bisa mengubah role akun sendiri.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,pewawancara',
        'password' => [
            'nullable',
            'min:8',
            'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/'
        ],
    ], [
        'password.regex' => 'Password harus mengandung huruf besar, kecil, angka, dan simbol.'
    ]);

    $user->name  = $request->name;
    $user->email = $request->email;
    $user->role  = $request->role;

    // hanya update password jika diisi
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User berhasil diperbarui.');
}

}
