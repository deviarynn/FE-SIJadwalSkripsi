@extends('layouts.app')

@section('title', 'Tambah Dosen')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Mahasiswa Baru</h1>
        <a href="{{ route('dosen.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Kembali ke Daftar</a>
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

    <form action="{{ route('dosen.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nidn" class="block text-gray-700 text-sm font-bold mb-2">NIDN:</label>
            <input type="text" name="nidn" id="nidn" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nidn') }}" required>
        </div>
        <div class="mb-4">
            <label for="nama_dosen" class="block text-gray-700 text-sm font-bold mb-2">Nama Dosen:</label>
            <input type="text" name="nama_dosen" id="nama_dosen" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nama_dosen') }}" required>
        </div>
        <div class="mb-4">
            <label for="program_studi" class="block text-gray-700 text-sm font-bold mb-2">Program Studi:</label>
            <select name="program_studi" id="program_studi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Program Studi</option>
                @foreach ($programStudiOptions as $option)
                    <option value="{{ $option }}" {{ old('program_studi') == $option ? 'selected' : '' }}>{{ $option }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}" required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200 ease-in-out">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
