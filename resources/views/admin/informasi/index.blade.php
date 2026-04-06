@extends('layouts.app')

@section('title', 'Informasi')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Data Informasi</h1>
        <a href="{{ route('admin.informasi.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
            Tambah Informasi
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Judul</th>
                    <th class="px-4 py-2 border">Isi</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($informasi as $item)
                    <tr>
                        <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $item->judul }}</td>
                        <td class="px-4 py-2 border">{{ Str::limit(strip_tags($item->isi), 100) }}</td>
                        <td class="px-4 py-2 border text-center">{{ $item->created_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 border text-center">
                            <a href="{{ route('admin.informasi.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded-md">Edit</a>
                            <form action="{{ route('admin.informasi.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus informasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 border text-center text-gray-500">Belum ada informasi tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
