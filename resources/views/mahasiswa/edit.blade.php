@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Mahasiswa: {{ $mahasiswa['data']['nama_mahasiswa'] ?? '' }}</h1>
        <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Kembali ke Daftar</a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (empty($mahasiswa) || empty($mahasiswa['data']))
        <p class="text-red-600">Data mahasiswa tidak ditemukan untuk diedit.</p>
    @else
        <form action="{{ route('mahasiswa.update', $mahasiswa['data']['npm']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="npm" class="block text-gray-700 text-sm font-bold mb-2">NPM:</label>
                <input type="text" name="npm" id="npm" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 cursor-not-allowed" value="{{ $mahasiswa['data']['npm'] ?? '' }}" readonly>
                <small class="text-gray-500">NPM tidak dapat diubah.</small>
            </div>
            <div class="mb-4">
                <label for="nama_mahasiswa" class="block text-gray-700 text-sm font-bold mb-2">Nama Mahasiswa:</label>
                <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nama_mahasiswa', $mahasiswa['data']['nama_mahasiswa'] ?? '') }}" required>
            </div>
            <div class="mb-4">
                <label for="program_studi" class="block text-gray-700 text-sm font-bold mb-2">Program Studi:</label>
                <select name="program_studi" id="program_studi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Pilih Program Studi</option>
                    @foreach ($programStudiOptions as $option)
                        <option value="{{ $option }}" {{ (old('program_studi', $mahasiswa['data']['program_studi'] ?? '') == $option) ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="judul_skripsi" class="block text-gray-700 text-sm font-bold mb-2">Judul Skripsi:</label>
                <textarea name="judul_skripsi" id="judul_skripsi" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('judul_skripsi', $mahasiswa['data']['judul_skripsi'] ?? '') }}</textarea>
            </div>
            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email', $mahasiswa['data']['email'] ?? '') }}" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200 ease-in-out">
                    Update
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
