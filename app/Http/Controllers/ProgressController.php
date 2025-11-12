<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\Modul;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    /**
     * Menampilkan halaman Progress Tracker.
     */
    public function index()
    {
        // Ambil pengguna (dari Auth atau session)
        $user = Auth::user() ?? Pengguna::where('nama', session('nama'))->first();
        $moduls = Modul::all();

        // Ambil progress user (jika login)
        $progressData = collect();
        if ($user) {
            $progressData = Progress::where('id_pengguna', $user->id_pengguna ?? $user->id)
                ->get(['id_modul', 'status']);
        }

        // Hitung persentase progress
        $totalModul = $moduls->count();
        $totalSelesai = $progressData->where('status', 'selesai')->count();
        $progressPercentage = $totalModul > 0
            ? round(($totalSelesai / $totalModul) * 100, 0)
            : 0;

        return view('progress-tracker', compact('moduls', 'progressData', 'progressPercentage'));
    }

    /**
     * Menyimpan atau memperbarui progress modul tertentu (manual dari form).
     */
    public function updateProgress(Request $request)
    {
        $request->validate([
            'id_modul' => 'required|exists:moduls,id_modul',
            'status' => 'required|string|max:255',
        ]);

        $user = Auth::user() ?? Pengguna::where('nama', session('nama'))->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        Progress::updateOrCreate(
            ['id_pengguna' => $user->id_pengguna ?? $user->id, 'id_modul' => $request->id_modul],
            ['status' => $request->status]
        );

        return redirect()->route('progress.index')->with('success', 'Progress berhasil diperbarui!');
    }

    /**
     * Menghapus progress tertentu.
     */
    public function destroy($id)
    {
        $progress = Progress::findOrFail($id);
        $progress->delete();

        return redirect()->route('progress.index')->with('success', 'Progress berhasil dihapus!');
    }

    /**
     * Fungsi bantu (dipanggil dari Materi/Kuis/Flashcard)
     */
    public static function saveProgress($id_modul, $status = 'sedang')
    {
        $user = Auth::user() ?? Pengguna::where('nama', session('nama'))->first();

        if (!$user) {
            return;
        }

        $id_pengguna = $user->id_pengguna ?? $user->id;

        $progress = Progress::where('id_pengguna', $id_pengguna)
            ->where('id_modul', $id_modul)
            ->first();

        if (!$progress) {
            Progress::create([
                'id_pengguna' => $id_pengguna,
                'id_modul' => $id_modul,
                'status' => $status,
            ]);
        } else {
            $progress->update(['status' => $status]);
        }
    }
}
