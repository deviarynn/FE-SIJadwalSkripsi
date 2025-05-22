# SI JADWAL SIDANG SKRIPSI KEL 2

Latihan laravel fetch API untuk persiapan uas pbf sebagai referensi modul

### Clone repository backend
```terminal
git clone https://github.com/MuhammadAbiAM/BE-Jadwal-Skripsi.git
```
Nyalakan server backend
```bash
php spark serve
```
Test apakah API endpoint backend sudah berjalan di Postman
```GET
GET → http://localhost:8080/mahasiswa
```
### Download database
https://github.com/mayangm09/DBE-SI-Penjadwalan-Skripsi.git

### Buat Laravel
Langkah:
Buat file project laravel dgn perintah 
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
SESSION_DRIVER=file
```

3. Buat folder layout app di view.
```php
resources\views\layouts\app.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Skripsi')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom CSS untuk transisi sidebar */
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        .content-area {
            transition: margin-left 0.3s ease-in-out;
        }
        .animate-fade-in {
            opacity: 0;
            transform: translateY(20px);
        }
        /* CSS untuk rotasi ikon dropdown */
        .dropdown-toggle.active .arrow-icon {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="bg-gray-200 overflow-x-hidden font-sans">

    <nav class="bg-blue-700 shadow-md p-4 flex justify-between items-center fixed w-full z-20 top-0">
        <div class="flex items-center">
            <button id="sidebarToggle" class="text-white focus:outline-none mr-4 lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <div class="text-xl font-bold text-white">
                Dashboard Skripsi
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-gray-100 hidden md:block">Halo, Devi!</span>
            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Logout</button>
        </div>
    </nav>

    <div class="flex pt-16">

        <aside id="sidebar" class="sidebar w-64 bg-gray-900 text-white fixed h-screen p-4 z-10 lg:translate-x-0">
            <div class="text-2xl font-semibold mb-6 text-center">Menu</div>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ url('/') }}" class="flex items-center p-3 rounded-md hover:bg-gray-700 transition duration-200 ease-in-out {{ Request::is('/') ? 'bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Dashboard
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('dosen.index') }}" class="flex items-center p-3 rounded-md hover:bg-gray-700 transition duration-200 ease-in-out {{ Request::is('dosen*') ? 'bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18H6a2 2 0 01-2-2V6a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2z"></path></svg>
                            Dosen
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('mahasiswa.index') }}" class="flex items-center p-3 rounded-md hover:bg-gray-700 transition duration-200 ease-in-out {{ Request::is('mahasiswa*') ? 'bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18H6a2 2 0 01-2-2V6a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2z"></path></svg>
                            Mahasiswa
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('ruangan.index') }}" class="flex items-center p-3 rounded-md hover:bg-gray-700 transition duration-200 ease-in-out {{ Request::is('ruangan*') ? 'bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                            Ruangan
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main id="contentArea" class="content-area flex-1 ml-64 p-8">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const contentArea = document.getElementById('contentArea');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Fungsi untuk mengontrol visibilitas sidebar
        const toggleSidebar = () => {
            sidebar.classList.toggle('sidebar-hidden');
            // Menyesuaikan margin konten saat sidebar tersembunyi/muncul
            if (sidebar.classList.contains('sidebar-hidden')) {
                contentArea.classList.remove('ml-64');
                contentArea.classList.add('ml-0');
            } else {
                contentArea.classList.remove('ml-0');
                contentArea.classList.add('ml-64');
            }
        };

        // Event listener untuk tombol toggle sidebar
        sidebarToggle.addEventListener('click', toggleSidebar);

        // Atur status awal sidebar berdasarkan ukuran layar
        const adjustSidebarOnLoad = () => {
            if (window.innerWidth < 1024) { // 1024px adalah breakpoint 'lg' di Tailwind
                sidebar.classList.add('sidebar-hidden');
                contentArea.classList.remove('ml-64');
                contentArea.classList.add('ml-0');
            } else {
                sidebar.classList.remove('sidebar-hidden');
                contentArea.classList.remove('ml-0');
                contentArea.classList.add('ml-64');
            }
        };

        // Panggil saat halaman dimuat
        adjustSidebarOnLoad();

        // Panggil saat ukuran layar diubah
        window.addEventListener('resize', adjustSidebarOnLoad);

        // Animasi dasar untuk kartu (Anda bisa menggunakan library seperti AOS untuk yang lebih canggih)
        const cards = document.querySelectorAll('.animate-fade-in');
        cards.forEach((card, index) => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                card.style.opacity = 1;
                card.style.transform = 'translateY(0)';
            }, 100 + (index * 150)); // Tunda setiap kartu
        });

        // --- JavaScript untuk Dropdown Sidebar ---
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah navigasi default
                const targetId = this.dataset.target;
                const submenu = document.getElementById(targetId);
                const arrowIcon = this.querySelector('.arrow-icon');

                // Tutup semua sub-menu lain kecuali yang sedang diklik
                document.querySelectorAll('.dropdown-toggle').forEach(otherToggle => {
                    if (otherToggle !== this) {
                        const otherSubmenu = document.getElementById(otherToggle.dataset.target);
                        if (otherSubmenu && !otherSubmenu.classList.contains('hidden')) {
                            otherSubmenu.classList.add('hidden');
                            otherToggle.classList.remove('active');
                        }
                    }
                });

                submenu.classList.toggle('hidden');
                this.classList.toggle('active'); // Tambah/hapus kelas 'active' pada tombol toggle
            });
        });

        // Pastikan sub-menu terbuka jika ada item di dalamnya yang aktif saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                const targetId = toggle.dataset.target;
                const submenu = document.getElementById(targetId);
                const arrowIcon = toggle.querySelector('.arrow-icon');

                // Cek jika ada link aktif di dalam submenu
                const activeSublink = submenu.querySelector('a.bg-gray-700');
                if (activeSublink) {
                    submenu.classList.remove('hidden');
                    toggle.classList.add('active'); // Set parent toggle as active
                }
            });
        });
    </script>
</body>
</html>


```
4. Buat Dashboard di dalam view
```php
resources\views\dashboard.blade.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Skripsi')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for sidebar transition */
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        .content-area {
            transition: margin-left 0.3s ease-in-out;
        }
        .animate-fade-in {
            opacity: 0;
            transform: translateY(20px);
        }
    </style>
</head>
<body class="bg-gray-200 overflow-x-hidden font-sans">

    <nav class="bg-blue-700 shadow-md p-4 flex justify-between items-center fixed w-full z-20 top-0">
        <div class="flex items-center">
            <button id="sidebarToggle" class="text-white focus:outline-none mr-4 lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <div class="text-xl font-bold text-white">
                Dashboard Skripsi
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-gray-100 hidden md:block">Halo, Admin!</span>
            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Logout</button>
        </div>
    </nav>

    <div class="flex pt-16">

        <aside id="sidebar" class="sidebar w-64 bg-gray-900 text-white fixed h-screen p-4 z-10 lg:translate-x-0">
            <div class="text-2xl font-semibold mb-6 text-center">Menu</div>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ url('/') }}" class="flex items-center p-3 rounded-md hover:bg-teal-600 transition duration-200 ease-in-out {{ Request::is('/') ? 'bg-teal-600' : '' }}">
                            <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('dosen.index') }}" class="flex items-center p-3 rounded-md hover:bg-teal-600 transition duration-200 ease-in-out {{ Request::is('dosen*') ? 'bg-teal-600' : '' }}">
                            <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18H6a2 2 0 01-2-2V6a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2z"></path></svg>
                            Dosen
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('mahasiswa.index') }}" class="flex items-center p-3 rounded-md hover:bg-teal-600 transition duration-200 ease-in-out {{ Request::is('mahasiswa*') ? 'bg-teal-600' : '' }}">
                            <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18H6a2 2 0 01-2-2V6a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2z"></path></svg>
                            Mahasiswa
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('ruangan.index') }}" class="flex items-center p-3 rounded-md hover:bg-teal-600 transition duration-200 ease-in-out {{ Request::is('ruangan*') ? 'bg-teal-600' : '' }}">
                            <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                            Ruangan
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
@extends('layouts.app')

@section('title', 'Dashboard Skripsi')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>
<p class="text-gray-700 mb-8">Selamat datang di halaman dashboard skripsi Anda. Di sini Anda dapat mengelola data mahasiswa, dan ruangan.</p>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    {{-- Card untuk Jumlah Dosen --}}
    {{-- <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">Jumlah Dosen</h2>
        <p class="text-4xl font-bold text-blue-600">50</p>
        <p class="text-gray-600 mt-2">Dosen aktif yang terdaftar.</p>
    </div> --}}

    {{-- Card untuk Jumlah Mahasiswa --}}
    <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in delay-100">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">Jumlah Mahasiswa</h2>
        <p class="text-4xl font-bold text-blue-600">200</p>
        <p class="text-gray-600 mt-2">Total mahasiswa terdaftar.</p>
    </div>

    {{-- Card untuk Informasi Ruangan --}}
    <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in delay-200">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">Informasi Ruangan</h2>
        <p class="text-lg text-gray-700">Ruangan Tersedia: <span class="font-bold">15</span></p>
        <p class="text-lg text-gray-700">Ruangan Digunakan: <span class="font-bold">5</span></p>
        <p class="text-gray-600 mt-2">Status ketersediaan ruangan saat ini.</p>
    </div>

    {{-- Anda bisa menambahkan lebih banyak card atau widget di sini --}}
    {{-- Contoh Card Tambahan (opsional) --}}
    <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in delay-300 col-span-1 md:col-span-2 lg:col-span-3">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">Pengumuman Terbaru</h2>
        <ul class="list-disc list-inside text-gray-700">
            <li class="mb-2">Perubahan jadwal maintenance sistem pada tanggal 25 Mei 2025.</li>
            <li class="mb-2">Pendaftaran sidang skripsi periode Juli akan dibuka minggu depan.</li>
            <li>Workshop penulisan ilmiah akan diadakan pada 10 Juni 2025.</li>
        </ul>
    </div>
</div>
@endsection
        <main id="contentArea" class="content-area flex-1 ml-64 p-8">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const contentArea = document.getElementById('contentArea');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Function to control sidebar visibility
        const toggleSidebar = () => {
            sidebar.classList.toggle('sidebar-hidden');
            // Adjust content margin when sidebar is hidden/shown
            if (sidebar.classList.contains('sidebar-hidden')) {
                contentArea.classList.remove('ml-64');
                contentArea.classList.add('ml-0');
            } else {
                contentArea.classList.remove('ml-0');
                contentArea.classList.add('ml-64');
            }
        };

        // Event listener for sidebar toggle button
        sidebarToggle.addEventListener('click', toggleSidebar);

        // Set initial sidebar status based on screen size
        const adjustSidebarOnLoad = () => {
            if (window.innerWidth < 1024) { // 1024px is Tailwind's 'lg' breakpoint
                sidebar.classList.add('sidebar-hidden');
                contentArea.classList.remove('ml-64');
                contentArea.classList.add('ml-0');
            } else {
                sidebar.classList.remove('sidebar-hidden');
                contentArea.classList.remove('ml-0');
                contentArea.classList.add('ml-64');
            }
        };

        // Call on page load
        adjustSidebarOnLoad();

        // Call on window resize
        window.addEventListener('resize', adjustSidebarOnLoad);

        // Basic animation for cards (you can use a library like AOS for more advanced ones)
        const cards = document.querySelectorAll('.animate-fade-in');
        cards.forEach((card, index) => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                card.style.opacity = 1;
                card.style.transform = 'translateY(0)';
            }, 100 + (index * 150)); // Delay each card
        });
    </script>
</body>
</html>
```
5. seluruh tampilan view, seperti folder mahasiswa, ruangan, dll untuk mempermudah pengerjaan krn sudah jadi satu file.
6. Buat halaman index, create, show dan edit di masing-masing folder tadi
7. Buat Controller



### Generate Controller
```php
php artisan make:controller DosenController
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

## ! Catatan penting lagi:
{ Pastikan saat edit atau inpu data baru, isi datanya sesuaikan dengan ketentuan }
Contoh: FE
```php
{
        // Validasi input dari form
        $request->validate([
            'nidn' => 'required|string|min:10',
            'nama_dosen' => 'required|string|max:50',
            'program_studi' => 'required|string',
            'email' => 'required|email|max:30',
        ]);

dan BE
 public function create()
    {
        $rules = $this->validate([
            'nidn' => [
                'rules' => 'required|numeric|min_length[10]|is_unique[dosen.nidn]',
                'errors' => [
                    'required'    => 'NIDN wajib diisi.',
                    'numeric'     => 'NIDN harus berupa angka.',
                    'min_length'  => 'NIDN minimal 10 karakter.',
                    'is_unique'   => 'NIDN sudah terdaftar.',
                ]
            ],
```
### ✅ Status CRUD Kedua Tabel
Fitur	     Status
Tampilkan     ✅
Tambah	      ✅
Edit	      ✅
Hapus	      ✅
