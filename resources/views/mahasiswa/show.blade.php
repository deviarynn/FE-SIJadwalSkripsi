@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Mahasiswa</h1>
        <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Kembali ke Daftar</a>
    </div>

    {{-- Memeriksa apakah data mahasiswa kosong atau tidak memiliki kunci 'data' --}}
    @if (empty($mahasiswa) || (isset($mahasiswa['data']) && empty($mahasiswa['data'])))
        <p class="text-red-600">Data mahasiswa tidak ditemukan.</p>
    @else
        {{-- Mengambil data mahasiswa yang sebenarnya, baik langsung dari $mahasiswa atau dari $mahasiswa['data'] --}}
        @php
            $mhs_data = $mahasiswa['data'] ?? $mahasiswa;
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 font-semibold">NPM:</p>
                <p class="text-gray-800 text-lg">{{ $mhs_data['npm'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Nama Mahasiswa:</p>
                <p class="text-gray-800 text-lg">{{ $mhs_data['nama_mahasiswa'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Program Studi:</p>
                <p class="text-gray-800 text-lg">{{ $mhs_data['program_studi'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Judul Skripsi:</p>
                <p class="text-gray-800 text-lg">{{ $mhs_data['judul_skripsi'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Email:</p>
                <p class="text-gray-800 text-lg">{{ $mhs_data['email'] ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="mt-8 flex space-x-4">
            <a href="{{ route('mahasiswa.edit', $mhs_data['npm'] ?? '') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Edit</a>
            <form action="{{ route('mahasiswa.destroy', $mhs_data['npm'] ?? '') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Hapus</button>
            </form>
        </div>
    @endif
</div>
@endsection
