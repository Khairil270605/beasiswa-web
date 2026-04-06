@extends('layouts.app')

@section('title', 'Form Pendaftaran Beasiswa')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-indigo-600 mb-6">Formulir Pendaftaran Beasiswa</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('daftar.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
        @csrf

        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="nilai" class="block text-gray-700 font-bold mb-2">Nilai Rata-Rata</label>
            <input type="number" step="0.01" id="nilai" name="nilai" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        {{-- Tambahkan isian lain sesuai kebutuhan, misalnya penghasilan, tanggungan, dan lain-lain --}}
        <div class="mb-4">
            <label for="penghasilan" class="block text-gray-700 font-bold mb-2">Penghasilan Orang Tua (Rp)</label>
            <input type="number" id="penghasilan" name="penghasilan" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="tanggungan" class="block text-gray-700 font-bold mb-2">Jumlah Tanggungan</label>
            <input type="number" id="tanggungan" name="tanggungan" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-6">
            <label for="prestasi" class="block text-gray-700 font-bold mb-2">Prestasi Akademik/Non-akademik</label>
            <textarea id="prestasi" name="prestasi" rows="3"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Daftar Sekarang
            </button>
        </div>
    </form>
</div>
@endsection
