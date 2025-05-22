# SI JADWAL SIDANG SKRIPSI

Latihan laravel restfull API untuk persiapan uas pbf sebagai referensi modul

Langkah:
1. Buat file project laravel dgn perintah 
```bash
composer create-project laravel/laravel namaprojek
```

2. nyalakan server laravel
```bash
php artisan serve
```

#### ubah di .env
```php
APP_NAME=Laravel
APP_URL=http://localhost
```

3. Buat folder layouts/app.blade.php di view.
4. Buat seluruh tampilan view, termasuk folder mahasiswa, ruangan, dll untuk mempermudah pengerjaan krn sudah jadi satu file.
5. Buat halaman index, create dan edit di semua folder tadi
6. Buat Controller


#### Di Routes/web.php
```php
Route::get('/', function () {
    return view('dashboard');
});
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('ruangan', RuanganController::class);
```

### Generate Controller
```php
php artisan make:controller MahasiswaController
php artisan make:controller RuanganController
```
Contoh di RuanganController
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RuanganController extends Controller
{
    // Base URL untuk API Ruangan
    private $apiUrl = 'http://localhost:8080/ruangan';

     */
    public function index()
    {
        $ruangan = [];
        $errors = []; // Inisialisasi array errors

        try {
            $response = Http::get($this->apiUrl);

            // Periksa jika request berhasil (status 2xx)
            if ($response->successful()) {
                $ruangan = $response->json(); // Ambil data JSON dari response
            } else {
                // Tangani error jika API tidak mengembalikan status sukses
                $errors['api_error'] = $response->json()['message'] ?? 'Gagal mengambil data ruangan.';
            }
        } catch (\Exception $e) {
            // Tangani exception jika ada masalah koneksi atau lainnya
            $errors['connection_error'] = 'Tidak dapat terhubung ke API: ' . $e->getMessage();
        }

        // Teruskan variabel errors ke view
        return view('ruangan.index', compact('ruangan', 'errors'));
    }

    /**
     * Menampilkan detail satu ruangan.

     */
    public function show($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/{$id}");

            if ($response->successful()) {
                $ruangan = $response->json();
                return view('ruangan.show', compact('ruangan'));
            } else {
                $errorMessage = $response->json()['message'] ?? 'Ruangan tidak ditemukan.';
                return redirect()->route('ruangan.index')->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return redirect()->route('ruangan.index')->with('error', 'Tidak dapat terhubung ke API: ' . $e->getMessage());
        }
    }

    /**

     */
    public function create()
    {
        return view('ruangan.create');
    }

    /**
     * Menyimpan ruangan baru ke API.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'kode_ruangan' => 'required|string|max:6',
            'nama_ruangan' => 'required|string|max:40',
        ]);

        try {
            $response = Http::post($this->apiUrl, $request->all());

            if ($response->successful()) {
                return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil ditambahkan!');
            } else {
                $errorMessage = $response->json()['message'] ?? 'Gagal menambahkan data ruangan.';
                return redirect()->back()->withInput()->withErrors(['api_error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['connection_error' => 'Tidak dapat terhubung ke API: ' . $e->getMessage()]);
        }
    }

    /**
     * Menampilkan form untuk mengedit ruangan.
     */
    public function edit($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/{$id}");

            if ($response->successful()) {
                $ruangan = $response->json();
                return view('ruangan.edit', compact('ruangan'));
            } else {
                $errorMessage = $response->json()['message'] ?? 'Ruangan tidak ditemukan.';
                return redirect()->route('ruangan.index')->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return redirect()->route('ruangan.index')->with('error', 'Tidak dapat terhubung ke API: ' . $e->getMessage());
        }
    }

    /**
     * Mengupdate data ruangan melalui API.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_ruangan' => 'required|string|max:40',
        ]);

        try {
            // Perhatikan bahwa kode_ruangan tidak diupdate karena itu adalah primary key
            $response = Http::put("{$this->apiUrl}/{$id}", $request->except('kode_ruangan')); // Kirim semua data kecuali kode_ruangan

            if ($response->successful()) {
                return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil diperbarui!');
            } else {
                $errorMessage = $response->json()['message'] ?? 'Gagal memperbarui data ruangan.';
                return redirect()->back()->withInput()->withErrors(['api_error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['connection_error' => 'Tidak dapat terhubung ke API: ' . $e->getMessage()]);
        }
    }

    /**
     * Menghapus data ruangan melalui API.
     */
    public function destroy($id)
    {
        try {
            $response = Http::delete("{$this->apiUrl}/{$id}");

            if ($response->successful()) {
                return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil dihapus!');
            } else {
                $errorMessage = $response->json()['message'] ?? 'Gagal menghapus data ruangan.';
                return redirect()->route('ruangan.index')->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return redirect()->route('ruangan.i2. git init
ndex')->with('error', 'Tidak dapat terhubung ke API: ' . $e->getMessage());
        }
    }
}

```
## NOTED:
Di RuanganController CI milik backend, function update bagian validasi kode ruangan dihapus
```php
'kode_ruangan' => [
            'rules' => 'required|alpha_numeric_punct|min_length[3]|is_unique[ruangan.kode_ruangan,kode_ruangan,' . $kode_ruangan . ']',
            'errors' => [
            'required'              => 'Kode ruangan wajib diisi.',
            'alpha_numeric_punct'   => 'Kode ruangan hanya boleh huruf, angka, spasi, dan tanda baca.',
            'min_length'            => 'Kode ruangan minimal 3 karakter.',
            'is_unique'             => 'Kode ruangan sudah terdaftar.',
                  ]
             ],

```
Dihilangkan saja karena kode_ruangan adalah primary key yang digunakan untuk mengidentifikasi record yang akan diupdate, dan nilainya tidak berubah/tidak dapat diubah. Hanya perlu memvalidasi data yang memang bisa diubah, yaitu nama_ruangan.

### Halaman View(blade)
1. resources/views/ruangan/index.blade.php
```php
@extends('layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Ruangan</h1>
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
        <div class="p-4 rounded-lg bg-gray-300 dark:bg-gray-800" id="ruangan" role="tabpanel" aria-labelledby="ruangan-tab">
            <div class="flex justify-end mb-4">
                <a href="{{ route('ruangan.create') }}" class="bg-green-800 hover:bg-green-900 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Tambah</a>
            </div>
            @if (empty($ruangan) || empty($ruangan['data'])) {{-- Check if 'data' key exists and is not empty --}}
                <p class="text-gray-600">Tidak ada data ruangan yang tersedia.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-blue-300 rounded-lg">
                        <thead>
                            <tr class="bg-blue-800 text-white uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Kode Ruangan</th>
                                <th class="py-3 px-6 text-left">Nama ruangan</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            @foreach ($ruangan['data'] as $ruang) {{-- Changed from $ruangan to $ruangan['data'] --}}
                                <tr class="border-b border-blue-900 hover:bg-blue-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $ruang['kode_ruangan'] }}</td>
                                    <td class="py-3 px-6 text-left">{{ $ruang['nama_ruangan'] }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center space-x-2">
                                            {{-- <a href="{{ route('ruangan.show', $ruang['kode_ruangan']) }}" class="text-blue-500 hover:text-blue-700 transition duration-200 ease-in-out" title="Lihat Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a> --}}
                                            <a href="{{ route('ruangan.edit', $ruang['kode_ruangan']) }}" class="text-yellow-500 hover:text-yellow-700 transition duration-200 ease-in-out" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('ruangan.destroy', $ruang['kode_ruangan']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ruangan ini?');">
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
@endsection

```
2. create.blade.php dan edit.blade.php
a. ruangan/create.blade.php
```php
@extends('layouts.app')

@section('title', 'Tambah Ruangan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Ruangan Baru</h1>
        <a href="{{ route('ruangan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Kembali ke Daftar</a>
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

    <form action="{{ route('ruangan.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="kode_ruangan" class="block text-gray-700 text-sm font-bold mb-2">Kode Ruangan:</label>
            <input type="text" name="kode_ruangan" id="kode_ruangan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('kode_ruangan') }}" required maxlength="6">
        </div>
        <div class="mb-4">
            <label for="nama_ruangan" class="block text-gray-700 text-sm font-bold mb-2">Nama Ruangan:</label>
            <input type="text" name="nama_ruangan" id="nama_ruangan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nama_ruangan') }}" required maxlength="40">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200 ease-in-out">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
```

b. ruangan/edit.blade.php
```php
@extends('layouts.app')

@section('title', 'Edit ruangan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit ruangan: {{ $ruangan['data']['nama_ruangan'] ?? '' }}</h1>
        <a href="{{ route('ruangan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Kembali ke Daftar</a>
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

    @if (empty($ruangan) || empty($ruangan['data']))
        <p class="text-red-600">Data ruangan tidak ditemukan untuk diedit.</p>
    @else
        <form action="{{ route('ruangan.update', $ruangan['data']['kode_ruangan']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="kode_ruangan" class="block text-gray-700 text-sm font-bold mb-2">Kode Ruangan:</label>
                <input type="text" name="kode_ruangan" id="kode_ruangan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 cursor-not-allowed" value="{{ $ruangan['data']['kode_ruangan'] ?? '' }}" readonly>
                <small class="text-gray-500">Kode ruangan tidak dapat diubah.</small>
            </div>
            <div class="mb-4">@extends('layouts.app')

@section('title', 'Edit Ruangan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Ruangan: {{ $ruangan['nama_ruangan'] ?? '' }}</h1>
        <a href="{{ route('ruangan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Kembali ke Daftar</a>
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

    @if (empty($ruangan) || empty($ruangan['data'])) {{-- Add check for 'data' key if API response wraps data --}}
        <p class="text-red-600">Data ruangan tidak ditemukan untuk diedit.</p>
    @else
        <form action="{{ route('ruangan.update', $ruangan['kode_ruangan'] ?? $ruangan['data']['kode_ruangan']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="kode_ruangan" class="block text-gray-700 text-sm font-bold mb-2">Kode Ruangan:</label>
                {{-- Access 'kode_ruangan' from 'data' if API wraps it --}}
                <input type="text" name="kode_ruangan" id="kode_ruangan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 cursor-not-allowed" value="{{ $ruangan['kode_ruangan'] ?? $ruangan['data']['kode_ruangan'] ?? '' }}" readonly>
                <small class="text-gray-500">Kode Ruangan tidak dapat diubah.</small>
            </div>
            <div class="mb-4">
                <label for="nama_ruangan" class="block text-gray-700 text-sm font-bold mb-2">Nama Ruangan:</label>
                {{-- Access 'nama_ruangan' from 'data' if API wraps it --}}
                <input type="text" name="nama_ruangan" id="nama_ruangan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nama_ruangan', $ruangan['nama_ruangan'] ?? $ruangan['data']['nama_ruangan'] ?? '') }}" required maxlength="40">
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

                <label for="nama_ruangan" class="block text-gray-700 text-sm font-bold mb-2">Nama ruangan:</label>
                <input type="text" name="nama_ruangan" id="nama_ruangan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nama_ruangan', $ruangan['data']['nama_ruangan'] ?? '') }}" required>
            </div>
            {{-- <div class="mb-4">
                <label for="program_studi" class="block text-gray-700 text-sm font-bold mb-2">Program Studi:</label>
                <select name="program_studi" id="program_studi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Pilih Program Studi</option>
                    @foreach ($programStudiOptions as $option)
                        <option value="{{ $option }}" {{ (old('program_studi', $ruangan['data']['program_studi'] ?? '') == $option) ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div> --}}
            {{-- <div class="mb-4">
                <label for="judul_skripsi" class="block text-gray-700 text-sm font-bold mb-2">Judul Skripsi:</label>
                <textarea name="judul_skripsi" id="judul_skripsi" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('judul_skripsi', $ruangan['data']['judul_skripsi'] ?? '') }}</textarea>
            </div>
            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email', $ruangan['data']['email'] ?? '') }}" required>
            </div> --}}
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200 ease-in-out">
                    Update
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
```
✅ Status CRUD Kedua Tabel
Fitur	Status
Tampilkan	✅
Tambah	✅
Edit	✅
Hapus	✅
