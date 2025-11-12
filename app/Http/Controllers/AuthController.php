<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /** 
     * Tampilkan halaman register
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses registrasi user baru
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:penggunas,email',
            'password' => 'required|min:6|confirmed'
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Proses login untuk admin atau user
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek admin
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['role' => 'admin', 'nama' => $admin->nama]);
            return redirect()->route('materi.index');
        }

        // Cek pengguna
        $user = Pengguna::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['role' => 'user', 'nama' => $user->nama]);
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    /**
     * Logout dan arahkan ke halaman login
     */
    public function logout(Request $request)
    {
        // Logout jika menggunakan Auth bawaan Laravel
        Auth::logout();

        // Hapus semua data session (baik user maupun admin)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
