<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Tampilkan daftar banner
     */
    public function index()
    {
        $banners = Banner::ordered()->get();

        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Form tambah banner
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Simpan banner baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'nullable|string|max:255',
            'image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'      => 'nullable|url',
            'order'     => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        // Upload file
        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('uploads/banners'), $filename);

        $path = 'uploads/banners/'.$filename;

        Banner::create([
            'title'     => $request->title,
            'image'     => $path,
            'link'      => $request->link,
            'order'     => $request->order,
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil ditambahkan');
    }

    /**
     * Form edit banner
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update banner
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title'     => 'nullable|string|max:255',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'      => 'nullable|url',
            'order'     => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {

            // Hapus file lama
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            // Upload file baru
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads/banners'), $filename);

            $banner->image = 'uploads/banners/'.$filename;
        }

        $banner->update([
            'title'     => $request->title,
            'link'      => $request->link,
            'order'     => $request->order,
            'is_active' => $request->is_active,
            'image'     => $banner->image,
        ]);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil diperbarui');
    }

    /**
     * Hapus banner
     */
    public function destroy(Banner $banner)
    {
        // Hapus file
        if ($banner->image && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }

        $banner->delete();

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil dihapus');
    }
}