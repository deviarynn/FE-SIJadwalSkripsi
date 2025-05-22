<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DosenController extends Controller
{
    // Base URL untuk API dosen
    private $apiUrl = 'http://localhost:8080/dosen';

    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dosen = [];
        $errors = [];

        try {
            // Ambil data 
            $dosenResponse = Http::get($this->apiUrl);
            if ($dosenResponse->successful()) {
                $dosen = $dosenResponse->json(); // Ambil data JSON dari response
            } else {
                // Tangani error jika API tidak mengembalikan status sukses
                $errors['dosen_api_error'] = $dosenResponse->json()['message'] ?? 'Gagal mengambil data dosen.';
            }
        } catch (\Exception $e) {
            // Tangani exception jika ada masalah koneksi atau lainnya
            $errors['dosen_connection_error'] = 'Tidak dapat terhubung ke API dosen: ' . $e->getMessage();
        }

        return view('dosen.index', compact('dosen', 'errors'));
    }

    /**
     * Menampilkan detail satu dosen.
     *
     * @param string $id NPM dosen
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/{$id}");

            if ($response->successful()) {
                $dosen = $response->json();
                return view('dosen.show', compact('dosen'));
            } else {
                $errorMessage = $response->json()['message'] ?? 'dosen tidak ditemukan.';
                return redirect()->route('dosen.index')->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return redirect()->route('dosen.index')->with('error', 'Tidak dapat terhubung ke API: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form untuk membuat dosen baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Daftar program studi sesuai dengan ENUM di tabel database
        $programStudiOptions = [
            'D3 Teknik Elektronika',
            'D3 Teknik Listrik',
            'D3 Teknik Informatika',
            'D3 Teknik Mesin',
            'D4 Teknik Pengendalian Pencemaran Lingkungan',
            'D4 Pengembangan Produk Agroindustri',
            'D4 Teknologi Rekayasa Energi Terbarukan',
            'D4 Rekayasa Kimia Industri',
            'D4 Teknologi Rekayasa Mekatronika',
            'D4 Rekayasa Keamanan Siber',
            'D4 Teknologi Rekayasa Multimedia',
            'D4 Akuntansi Lembaga Keuangan Syariah',
            'D4 Rekayasa Perangkat Lunak',
        ];
        return view('dosen.create', compact('programStudiOptions'));
    }

    /**
     * Menyimpan dosen baru ke API.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nidn' => 'required|string|min:10',
            'nama_dosen' => 'required|string|max:50',
            'program_studi' => 'required|string',
            'email' => 'required|email|max:30',
        ]);

        try {
            $response = Http::post($this->apiUrl, $request->all());

            if ($response->successful()) {
                return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan!');
            } else {
                $errorMessage = $response->json()['message'] ?? 'Gagal menambahkan data dosen.';
                return redirect()->back()->withInput()->withErrors(['api_error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['connection_error' => 'Tidak dapat terhubung ke API: ' . $e->getMessage()]);
        }
    }

    /**
     * Menampilkan form untuk mengedit dosen.
     *
     * @param string $id NPM dosen
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/{$id}");

            if ($response->successful()) {
                $dosen = $response->json();
                $programStudiOptions = [
                    'D3 Teknik Elektronika', 'D3 Teknik Listrik', 'D3 Teknik Informatika', 'D3 Teknik Mesin',
                    'D4 Teknik Pengendalian Pencemaran Lingkungan', 'D4 Pengembangan Produk Agroindustri',
                    'D4 Teknologi Rekayasa Energi Terbarukan', 'D4 Rekayasa Kimia Industri',
                    'D4 Teknologi Rekayasa Mekatronika', 'D4 Rekayasa Keamanan Siber',
                    'D4 Teknologi Rekayasa Multimedia', 'D4 Akuntansi Lembaga Keuangan Syariah',
                    'D4 Rekayasa Perangkat Lunak',
                ];
                return view('dosen.edit', compact('dosen', 'programStudiOptions'));
            } else {
                $errorMessage = $response->json()['message'] ?? 'dosen tidak ditemukan.';
                return redirect()->route('dosen.index')->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return redirect()->route('dosen.index')->with('error', 'Tidak dapat terhubung ke API: ' . $e->getMessage());
        }
    }

    /**
     * Mengupdate data dosen melalui API.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id NPM dosen
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_dosen' => 'required|string|max:50',
            'program_studi' => 'required|string',
            'email' => 'required|email|max:30',
        ]);

        try {
            // Perhatikan bahwa NPM tidak diupdate karena itu adalah primary key
            $response = Http::put("{$this->apiUrl}/{$id}", $request->except('npm')); // Kirim semua data kecuali NPM

            if ($response->successful()) {
                return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui!');
            } else {
                $errorMessage = $response->json()['message'] ?? 'Gagal memperbarui data dosen.';
                return redirect()->back()->withInput()->withErrors(['api_error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['connection_error' => 'Tidak dapat terhubung ke API: ' . $e->getMessage()]);
        }
    }

    /**
     * Menghapus data dosen melalui API.
     *
     * @param string $id NPM dosen
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $response = Http::delete("{$this->apiUrl}/{$id}");

            if ($response->successful()) {
                return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus!');
            } else {
                $errorMessage = $response->json()['message'] ?? 'Gagal menghapus data dosen.';
                return redirect()->route('dosen.index')->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return redirect()->route('dosen.index')->with('error', 'Tidak dapat terhubung ke API: ' . $e->getMessage());
        }
    }
}
