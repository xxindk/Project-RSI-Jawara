<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modul;

class DashboardController extends Controller
{
// DashboardController.php
public function index()
{
    // Ambil modul aktif terbaru saja
    $moduls = Modul::where('status', 1)
                   ->orderBy('nomor_urut')
                   ->get();

    return view('dashboard.user', compact('moduls'));
}

}
