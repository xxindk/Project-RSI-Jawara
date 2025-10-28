<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Method utama untuk menampilkan dashboard user
    public function index()
    {
        // Nanti kamu bisa kirim data ke view lewat compact()
        return view('dashboard.user');
    }
}
