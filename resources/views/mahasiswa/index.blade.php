@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Mahasiswa</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if (!empty($errors))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <ul>
                @foreach ($errors as $key => $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="myTabContent">
        <div class="p-4 rounded-lg bg-gray-300 dark:bg-gray-800" id="mahasiswa" role="tabpanel" aria-labelledby="mahasiswa-tab">
            <div class="flex justify-end mb-4">
                <a href="{{ route('mahasiswa.create') }}" class="bg-green-800 hover:bg-green-900 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Tambah Mahasiswa</a>
            </div>
            @if (empty($mahasiswa) || empty($mahasiswa['data'])) {{-- Check if 'data' key exists and is not empty --}}
                <p class="text-gray-600">Tidak ada data mahasiswa yang tersedia.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-blue-300 rounded-lg">
                        <thead>
                            <tr class="bg-blue-800 text-white uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left ">NPM</th>
                                <th class="py-3 px-6 text-left">Nama Mahasiswa</th>
                                <th class="py-3 px-6 text-left">Program Studi</th>
                                <th class="py-3 px-6 text-left">Judul Skripsi</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            @foreach ($mahasiswa['data'] as $mhs) {{-- Changed from $mahasiswa to $mahasiswa['data'] --}}
                                <tr class="border-b border-blue-900 hover:bg-blue-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $mhs['npm'] }}</td>
                                    <td class="py-3 px-6 text-left">{{ $mhs['nama_mahasiswa'] }}</td>
                                    <td class="py-3 px-6 text-left">{{ $mhs['program_studi'] }}</td>
                                    <td class="py-3 px-6 text-left">{{ $mhs['judul_skripsi'] }}</td>
                                    <td class="py-3 px-6 text-left">{{ $mhs['email'] }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center space-x-2">
                                            {{-- <a href="{{ route('mahasiswa.show', $mhs['npm']) }}" class="text-blue-500 hover:text-blue-700 transition duration-200 ease-in-out" title="Lihat Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a> --}}
                                            <a href="{{ route('mahasiswa.edit', $mhs['npm']) }}" class="text-yellow-500 hover:text-yellow-700 transition duration-200 ease-in-out" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('mahasiswa.destroy', $mhs['npm']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200 ease-in-out" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Tidak ada JavaScript untuk tab karena hanya ada satu bagian konten --}}
@endsection
