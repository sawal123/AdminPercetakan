<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $title = "Dashboard";
        return view('admin.dashboard', ['title' => $title]);
    }

    public function barang()
    {
        $title = "Barang";
        return view('admin.dashBarang', ['title' => $title]);
    }
    public function tagihan()
    {
        $title = "Tagihan";
        return view('admin.dashTagihan', ['title' => $title]);
    }
    public function pelanggan()
    {
        $title = "Pelanggan";
        return view('admin.dashPelanggan', ['title' => $title]);
    }
}
