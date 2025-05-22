@extends('layouts.app')

@section('title', 'Detail dosen')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Dosen</h1>
        <a href="{{ route('dosen.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Kembali ke Daftar</a>
    </div>

    {{-- Memeriksa apakah data dosen kosong atau tidak memiliki kunci 'data' --}}
    @if (empty($dosen) || (isset($dosen['data']) && empty($dosen['data'])))
        <p class="text-red-600">Data dosen tidak ditemukan.</p>
    @else
        {{-- Mengambil data dosen yang sebenarnya, baik langsung dari $dosen atau dari $dosen['data'] --}}
        @php
            $d = $dosen['data'] ?? $dosen;
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 font-semibold">NIDN:</p>
                <p class="text-gray-800 text-lg">{{ $d['nidn'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Nama dosen:</p>
                <p class="text-gray-800 text-lg">{{ $d['nama_dosen'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Program Studi:</p>
                <p class="text-gray-800 text-lg">{{ $d['program_studi'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Email:</p>
                <p class="text-gray-800 text-lg">{{ $d['email'] ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="mt-8 flex space-x-4">
            <a href="{{ route('dosen.edit', $d['nidn'] ?? '') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Edit</a>
            <form action="{{ route('dosen.destroy', $d['nidn'] ?? '') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dosen ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Hapus</button>
            </form>
        </div>
    @endif
</div>
@endsection
