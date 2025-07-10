<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function tagihan()
    {
        $back = null;
        $title = "Tagihan";
        return view('admin.dashTagihan', ['title' => $title, 'back' => $back]);
    }
    // ===========================
    public function tagihanCreate()
    {
        $back = '/dashboard/tagihan';
        $title = "Buat Invoice";
        return view('admin.dashTagihan.create', ['title' => $title, 'back' => $back]);
    }

    public function tagihanView($invoice)
    {
        $back = '/dashboard/tagihan';
        $title = "Lihat Invoice";
        return view('admin.dashTagihan.viewTagihan', ['title' => $title, 'back' => $back, 'invoice' => $invoice]);
    }
    public function tagihanEdit($invoice)
    {
        $back = '/dashboard/tagihan';
        $title = "Lihat Invoice";
        return view('admin.dashTagihan.editTagihan', ['title' => $title, 'back' => $back, 'invoice' => $invoice]);
    }
}
