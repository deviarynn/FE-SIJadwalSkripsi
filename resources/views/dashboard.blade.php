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
