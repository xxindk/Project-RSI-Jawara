<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modul;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard user
     */
    public function index()
    {
        // Ambil modul aktif terbaru saja
        $moduls = Modul::where('status', 1)
                       ->orderBy('nomor_urut')
                       ->get();

        return view('dashboard.user', compact('moduls'));
    }

    /**
     * Menampilkan halaman profil user
     */
    public function profile()
    {
        // arahkan ke resources/views/profile.blade.php
        return view('profile');
    }
}
