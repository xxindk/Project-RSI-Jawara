<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil nama dari session login
        $nama = session('nama');

        // Cari data pengguna di tabel penggunas
        $user = Pengguna::where('nama', $nama)->first();

        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $nama = session('nama');
        $user = Pengguna::where('nama', $nama)->first();

        if ($user) {
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => $request->filled('password')
                    ? bcrypt($request->password)
                    : $user->password,
            ]);

            // Update juga nama di session
            session(['nama' => $request->nama]);
        }

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
