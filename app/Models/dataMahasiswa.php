<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Pastikan ini nama tabel kelas Anda
    protected $primaryKey = 'npm'; 
    public $incrementing = false; // Set false jika primaryKey non-incrementing
    protected $keyType = 'int'; // Atau 'string' jika kode_kelas string

    protected $fillable = [
        // Daftar kolom yang bisa diisi secara massal
        'npm',
        'nama_mahasiswa',
        'program_studi',
        'judul_skripsi',
        'email',
    ];
}