@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="bg-white p-4 rounded-lg shadow-md"> {{-- Reduced padding from p-6 to p-4 --}}
    <div class="flex justify-between items-center mb-4"> {{-- Reduced mb-6 to mb-4 --}}
        <h1 class="text-xl font-bold text-gray-800">Data Mahasiswa</h1> {{-- Reduced text-2xl to text-xl --}}
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert"> {{-- Reduced mb-4 to mb-3 --}}
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3" role="alert"> {{-- Reduced mb-4 to mb-3 --}}
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if (!empty($errors))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3" role="alert"> {{-- Reduced mb-4 to mb-3 --}}
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <ul>
                @foreach ($errors as $key => $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="myTabContent">
        <div class="p-3 rounded-lg bg-gray-300 dark:bg-gray-800" id="mahasiswa" role="tabpanel" aria-labelledby="mahasiswa-tab"> {{-- Reduced padding from p-4 to p-3 --}}
            <div class="flex justify-end mb-3"> {{-- Reduced mb-4 to mb-3 --}}
                <a href="{{ route('mahasiswa.create') }}" class="bg-green-800 hover:bg-green-900 text-white px-3 py-1.5 rounded-md text-sm transition duration-200 ease-in-out">Tambah Mahasiswa</a> {{-- Reduced padding and added text-sm --}}
            </div>
            @if (empty($mahasiswa) || empty($mahasiswa['data'])) {{-- Check if 'data' key exists and is not empty --}}
                <p class="text-gray-600 text-sm">Tidak ada data mahasiswa yang tersedia.</p> {{-- Added text-sm --}}
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-blue-300 rounded-lg">
                        <thead>
                            <tr class="bg-blue-800 text-white uppercase text-xs leading-normal"> {{-- Reduced text-sm to text-xs --}}
                                <th class="py-2 px-4 text-left ">NPM</th> {{-- Reduced padding from py-3 px-6 to py-2 px-4 --}}
                                <th class="py-2 px-4 text-left">Nama Mahasiswa</th> {{-- Reduced padding --}}
                                <th class="py-2 px-4 text-left">Program Studi</th> {{-- Reduced padding --}}
                                <th class="py-2 px-4 text-left">Judul Skripsi</th> {{-- Reduced padding --}}
                                <th class="py-2 px-4 text-left">Email</th> {{-- Reduced padding --}}
                                <th class="py-2 px-4 text-center">Aksi</th> {{-- Reduced padding --}}
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-xs font-light"> {{-- Reduced text-sm to text-xs --}}
                            @foreach ($mahasiswa['data'] as $mhs) {{-- Changed from $mahasiswa to $mahasiswa['data'] --}}
                                <tr class="border-b border-blue-900 hover:bg-blue-100">
                                    <td class="py-1.5 px-4 text-left whitespace-nowrap">{{ $mhs['npm'] }}</td> {{-- Reduced padding to py-1.5 px-4 --}}
                                    <td class="py-1.5 px-4 text-left">{{ $mhs['nama_mahasiswa'] }}</td> {{-- Reduced padding --}}
                                    <td class="py-1.5 px-4 text-left">{{ $mhs['program_studi'] }}</td> {{-- Reduced padding --}}
                                    <td class="py-1.5 px-4 text-left">{{ $mhs['judul_skripsi'] }}</td> {{-- Reduced padding --}}
                                    <td class="py-1.5 px-4 text-left">{{ $mhs['email'] }}</td> {{-- Reduced padding --}}
                                    <td class="py-1.5 px-4 text-center"> {{-- Reduced padding --}}
                                        <div class="flex item-center justify-center space-x-1"> {{-- Reduced space-x-2 to space-x-1 --}}
                                            <a href="{{ route('mahasiswa.show', $mhs['npm']) }}" class="text-blue-500 hover:text-blue-700 transition duration-200 ease-in-out" title="Lihat Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> {{-- Reduced w-5 h-5 to w-4 h-4 --}}
                                            </a>
                                            <a href="{{ route('mahasiswa.edit', $mhs['npm']) }}" class="text-yellow-500 hover:text-yellow-700 transition duration-200 ease-in-out" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> {{-- Reduced w-5 h-5 to w-4 h-4 --}}
                                            </a>
                                            <form action="{{ route('mahasiswa.destroy', $mhs['npm']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200 ease-in-out" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> {{-- Reduced w-5 h-5 to w-4 h-4 --}}
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle dropdown visibility
        document.querySelectorAll('.status-dropdown-toggle').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent document click from immediately closing
                const dropdownMenu = this.nextElementSibling;
                dropdownMenu.classList.toggle('hidden');
            });
        });

        // Handle status option selection
        document.querySelectorAll('.status-option').forEach(option => {
            option.addEventListener('click', function(event) {
                event.preventDefault();
                const selectedStatus = this.dataset.status;
                const button = this.closest('.status-dropdown-menu').previousElementSibling;
                button.innerHTML = `${selectedStatus} <svg class="w-3 h-3 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>`;
                this.closest('.status-dropdown-menu').classList.add('hidden');

                // --- PENTING: Fungsionalitas Update Status ke Backend ---
                // Di sini Anda akan mengirim permintaan AJAX (misalnya, PUT request) ke API Anda
                // untuk memperbarui status mahasiswa di database.
                // Anda akan membutuhkan NPM mahasiswa (primary key) dan status yang dipilih.
                const npm = this.closest('tr').querySelector('td:first-child').textContent.trim();
                console.log(`Mengirim update status untuk NPM: ${npm} menjadi: ${selectedStatus}`);

                // Contoh AJAX request (Anda perlu mengimplementasikannya sesuai API Anda)
                // fetch(`/api/mahasiswa/${npm}/status`, { // Ganti dengan endpoint API Anda
                //     method: 'PUT',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Jika menggunakan CSRF token
                //     },
                //     body: JSON.stringify({ status: selectedStatus })
                // })
                // .then(response => response.json())
                // .then(data => {
                //     console.log('Status updated successfully:', data);
                //     // Tampilkan pesan sukses ke user
                // })
                // .catch(error => {
                //     console.error('Error updating status:', error);
                //     // Tampilkan pesan error ke user
                // });
                // --- Akhir Fungsionalitas Update Status ---
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            document.querySelectorAll('.status-dropdown-menu').forEach(menu => {
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });
        });
    });
</script>
@endsection
