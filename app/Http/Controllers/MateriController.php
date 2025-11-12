<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Modul;
use Illuminate\Http\Request;
use App\Http\Controllers\ProgressController;

class MateriController extends Controller
{
    // =========================
    // Halaman Admin
    // =========================

    public function index()
    {
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

        $validated = $request->validate([
            'judul_modul' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'nomor_urut' => 'required|integer',
            'tingkatan_bahasa' => 'required|string|max:50',
            'status' => 'required|boolean',
            'konten_teks' => 'nullable|string',
        ]);

        // Simpan modul
        $modul = Modul::create([
            'judul_modul' => $validated['judul_modul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'nomor_urut' => $validated['nomor_urut'],
            'tingkatan_bahasa' => $validated['tingkatan_bahasa'],
            'status' => $validated['status'],
        ]);

        // Simpan materi
        Materi::create([
    'id_materi' => $modul->id_modul,
    'id_modul' => $modul->id_modul,
    'konten_teks' => $validated['konten_teks'] ?? '',
        ]);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil disimpan.');
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

        $materi = Materi::with('modul')->findOrFail($id);

        $validated = $request->validate([
            'judul_modul' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'nomor_urut' => 'required|integer',
            'tingkatan_bahasa' => 'required|string|max:50',
            'status' => 'required|boolean',
            'konten_teks' => 'nullable|string',
        ]);

        // Update modul
        $materi->modul->update([
            'judul_modul' => $validated['judul_modul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'nomor_urut' => $validated['nomor_urut'],
            'tingkatan_bahasa' => $validated['tingkatan_bahasa'],
            'status' => $validated['status'],
        ]);

        // Update teks materi
        $materi->konten_teks = $validated['konten_teks'] ?? $materi->konten_teks;
        $materi->save();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diubah.');
    }

    public function destroy($id)
{
    if (session('role') !== 'admin') {
        return redirect('/login')->with('error', 'Anda harus login sebagai admin.');
    }

    $materi = Materi::with('modul')->findOrFail($id);
    
    // Hapus modul, materi akan otomatis terhapus karena onDelete('cascade')
    $materi->modul->delete();

    if (Materi::count() === 0 && Modul::count() === 0) {
        \DB::statement('ALTER TABLE materis AUTO_INCREMENT = 1;');
        \DB::statement('ALTER TABLE moduls AUTO_INCREMENT = 1;');
    }

    return redirect()->route('materi.index')->with('success', 'Materi dan modul berhasil dihapus.');
}


    // =========================
    // Halaman Pengguna (baca saja)
    // =========================

    public function dashboardUserMateri()
    {
        if (session('role') !== 'user') {
            return redirect('/login')->with('error', 'Anda harus login sebagai pengguna.');
        }

        $materis = Materi::with('modul')->orderBy('id_materi', 'desc')->get();
        return view('dashboard.user-materi', compact('materis'));
    }

public function showUserMateri($id)
{
    if (session('role') !== 'user') {
        return redirect('/login')->with('error', 'Anda harus login sebagai pengguna.');
    }

    $modul = \App\Models\Modul::findOrFail($id);
    $materi = \App\Models\Materi::where('id_modul', $modul->id_modul)->first();

    // ✅ Simpan progress ketika user membuka materi
        ProgressController::saveProgress($modul->id_modul, 'sedang');

        // (opsional) Jika user sudah sampai akhir halaman materi
        // panggil ini untuk menandai selesai:
        ProgressController::saveProgress($modul->id_modul, 'selesai');

        return view('user.materi', compact('modul', 'materi'));
}

}
