<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataMahasiswa;
use App\Models\dataJadwal;
use App\Models\dataRuangan;


class Dashboard extends Controller
{
    public function dashboard()
{
    $jumlahMahasiswa = dataMahasiswa::count();
    $jumlahRuangan = dataRuangan::count();            

    return view('dashboard', compact(
        'jumlahMahasiswa',
        'jumlahJadwal',
        'jumlahRuangan'
    ));
}


}