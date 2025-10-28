<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    // =========================
    // Halaman Admin
    // =========================

    // Tampilkan semua materi (Admin)
    public function index()
    {
        // Cek apakah admin
        if (session('role') !== 'admin') {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin.');
        }

        $materis = Materi::with('modul')->orderBy('id_materi', 'desc')->get();
        return view('admin.materi.index', compact('materis'));
    }

    public function create()
    {
        if (session('role') !== 'admin') {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin.');
        }

        return view('admin.materi.form', ['materi' => null]);
    }

    public function store(Request $request)
    {
        if (session('role') !== 'admin') {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin.');
        }

        try {
            $validated = $request->validate([
                'judul_modul' => 'required|string|max:100',
                'deskripsi' => 'nullable|string',
                'nomor_urut' => 'required|integer',
                'tingkatan_bahasa' => 'required|string|max:50',
                'status' => 'required|boolean',
                'konten_teks' => 'nullable|string',
                'konten_gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Simpan modul
            $modul = Modul::create([
                'judul_modul' => $validated['judul_modul'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'nomor_urut' => $validated['nomor_urut'],
                'tingkatan_bahasa' => $validated['tingkatan_bahasa'],
                'status' => $validated['status'],
            ]);

            // Simpan gambar (jika ada)
            $gambarPath = null;
            if ($request->hasFile('konten_gambar')) {
                $gambarPath = $request->file('konten_gambar')->store('materi', 'public');
            }

            // Simpan materi
            Materi::create([
                'id_modul' => $modul->id_modul,
                'konten_teks' => $validated['konten_teks'] ?? '',
                'konten_gambar' => $gambarPath,
            ]);

            return redirect()->route('materi.index')->with('success', 'Materi berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('materi.index')
                ->with('error', 'Materi gagal disimpan, mohon tunggu sesaat lagi.');
        }
    }

    public function edit($id)
    {
        if (session('role') !== 'admin') {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin.');
        }

        $materi = Materi::with('modul')->findOrFail($id);
        return view('admin.materi.form', compact('materi'));
    }

    public function update(Request $request, $id)
    {
        if (session('role') !== 'admin') {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin.');
        }

        try {
            $materi = Materi::with('modul')->findOrFail($id);

            $validated = $request->validate([
                'judul_modul' => 'required|string|max:100',
                'deskripsi' => 'nullable|string',
                'nomor_urut' => 'required|integer',
                'tingkatan_bahasa' => 'required|string|max:50',
                'status' => 'required|boolean',
                'konten_teks' => 'nullable|string',
                'konten_gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Update modul
            $materi->modul->update([
                'judul_modul' => $validated['judul_modul'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'nomor_urut' => $validated['nomor_urut'],
                'tingkatan_bahasa' => $validated['tingkatan_bahasa'],
                'status' => $validated['status'],
            ]);

            // Update gambar
            if ($request->hasFile('konten_gambar')) {
                if ($materi->konten_gambar) {
                    Storage::disk('public')->delete($materi->konten_gambar);
                }
                $materi->konten_gambar = $request->file('konten_gambar')->store('materi', 'public');
            }

            $materi->konten_teks = $validated['konten_teks'] ?? '';
            $materi->save();

            return redirect()->route('materi.index')->with('success', 'Materi berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->route('materi.index')
                ->with('error', 'Materi gagal diubah, mohon tunggu sesaat lagi.');
        }
    }

    public function destroy($id)
    {
        if (session('role') !== 'admin') {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin.');
        }

        try {
            $materi = Materi::with('modul')->findOrFail($id);

            if ($materi->konten_gambar) {
                Storage::disk('public')->delete($materi->konten_gambar);
            }

            // Hapus modul (cascade)
            $materi->modul->delete();

            return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('materi.index')
                ->with('error', 'Terjadi kesalahan saat menghapus materi.');
        }
    }

    // =========================
    // Halaman Pengguna (baca saja)
    // =========================

    public function dashboardUserMateri()
    {
        if (session('role') !== 'user') {
            return redirect('/login')->with('error', 'Anda harus login sebagai pengguna.');
        }

        // Ambil semua materi untuk pengguna
        $materis = Materi::with('modul')->orderBy('id_materi', 'desc')->get();

        return view('dashboard.user-materi', compact('materis'));
    }
}
