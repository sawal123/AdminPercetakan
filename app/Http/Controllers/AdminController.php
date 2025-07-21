<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $back = null;
        $title = "Dashboard";
        return view('admin.dashboard', ['title' => $title, 'back' => $back]);
    }

    public function barang()
    {
        $back = null;
        $title = "Daftar Barang";
        return view('admin.dashBarang', ['title' => $title, 'back' => $back]);
    }
    
    // ============================
    public function pelanggan()
    {
        $back = null;
        $title = "Pelanggan";
        return view('admin.dashPelanggan', ['title' => $title, 'back' => $back]);
    }

    public function pegawai()
    {
        $back = null;
        $title = "Pegawai";
        return view('admin.dashPegawai', ['title' => $title, 'back' => $back]);
    }
}
