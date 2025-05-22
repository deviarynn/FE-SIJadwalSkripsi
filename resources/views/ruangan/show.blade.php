@extends('layouts.app')

@section('title', 'Detail Ruangan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Ruangan</h1>
        <a href="{{ route('ruangan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Kembali ke Daftar</a>
    </div>

    {{-- Memeriksa apakah data ruangan kosong atau tidak memiliki kunci 'data' --}}
    @if (empty($ruangan) || (isset($ruangan['data']) && empty($ruangan['data'])))
        <p class="text-red-600">Data ruangan tidak ditemukan.</p>
    @else
        {{-- Mengambil data ruangan yang sebenarnya, baik langsung dari $ruangan atau dari $ruangan['data'] --}}
        @php
            $ruang = $ruangan['data'] ?? $ruangan;
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 font-semibold">Kode Ruangan:</p>
                <p class="text-gray-800 text-lg">{{ $ruang['kode_ruangan'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Nama Ruangan:</p>
                <p class="text-gray-800 text-lg">{{ $ruang['nama_ruangan'] ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="mt-8 flex space-x-4">
            <a href="{{ route('ruangan.edit', $ruang['kode_ruangan'] ?? '') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Edit</a>
            <form action="{{ route('ruangan.destroy', $ruang['kode_ruangan'] ?? '') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ruangan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Hapus</button>
            </form>
        </div>
    @endif
</div>
@endsection
