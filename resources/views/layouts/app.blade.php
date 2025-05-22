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
