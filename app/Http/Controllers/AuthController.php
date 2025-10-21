<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

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
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

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
            return redirect('/dashboard-admin');
        }

        // Cek pengguna
        $user = Pengguna::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['role' => 'user', 'nama' => $user->nama]);
            return redirect('/dashboard-user');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }

    // === GOOGLE LOGIN ===
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari pengguna berdasarkan email
            $user = Pengguna::where('email', $googleUser->getEmail())->first();

            // Jika belum ada, buat akun baru
            if (!$user) {
                $user = Pengguna::create([
                    'nama' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()), // password acak
                ]);
            }

            // Simpan session dan arahkan ke dashboard user
            session(['role' => 'user', 'nama' => $user->nama]);
            return redirect('/dashboard-user');

        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google.');
        }
    }
}
