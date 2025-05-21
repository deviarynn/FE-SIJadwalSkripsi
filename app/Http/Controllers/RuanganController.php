<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RuanganController extends Controller
{
    // Base URL untuk API Ruangan
    private $apiUrl = 'http://localhost:8080/ruangan';

    /**
     * Menampilkan daftar semua ruangan.
     *
     * @return \Illuminate\View\View
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
     *
     * @param string $id Kode ruangan
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
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
     * Menampilkan form untuk membuat ruangan baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('ruangan.create');
    }

    /**
     * Menyimpan ruangan baru ke API.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
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
     *
     * @param string $id Kode ruangan
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
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
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id Kode ruangan
     * @return \Illuminate\Http\RedirectResponse
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
     *
     * @param string $id Kode ruangan
     * @return \Illuminate\Http\RedirectResponse
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
