<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\Modul;
use App\Models\HasilKuis;
use App\Models\HasilDetail;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KuisController extends Controller
{
    // ===============================
    // ADMIN AREA
    // ===============================
    public function index()
    {
        $kuis = Kuis::with('modul')->orderBy('id_modul')->paginate(15);
        return view('admin.kuis.index', compact('kuis'));
    }

    public function create()
    {
        $moduls = Modul::where('status', 1)->orderBy('nomor_urut')->get();
        return view('admin.kuis.form', [
            'kuis' => new Kuis(),
            'moduls' => $moduls,
            'method' => 'POST',
            'action' => route('kuis.store')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_modul' => 'required|exists:moduls,id_modul',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
            'nilai' => 'nullable|integer'
        ]);

        Kuis::create($validated);
        return redirect()->route('kuis.index')->with('success', 'Soal kuis berhasil dibuat.');
    }

    public function edit($id)
    {
        $kuis = Kuis::findOrFail($id);
        $moduls = Modul::where('status', 1)->orderBy('nomor_urut')->get();
        return view('admin.kuis.form', [
            'kuis' => $kuis,
            'moduls' => $moduls,
            'method' => 'PUT',
            'action' => route('kuis.update', $kuis->id_kuis)
        ]);
    }

    public function update(Request $request, $id)
    {
        $kuis = Kuis::findOrFail($id);
        $validated = $request->validate([
            'id_modul' => 'required|exists:moduls,id_modul',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
            'nilai' => 'nullable|integer'
        ]);

        $kuis->update($validated);
        return redirect()->route('kuis.index')->with('success', 'Soal kuis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kuis = Kuis::findOrFail($id);
        $kuis->delete();
        return redirect()->route('kuis.index')->with('success', 'Soal kuis berhasil dihapus.');
    }

    // ===============================
    // USER FLOW: Start -> Play -> Answer -> Result
    // ===============================

    public function start($id_modul)
    {
        $soal = Kuis::where('id_modul', $id_modul)->inRandomOrder()->limit(10)->get();

        if ($soal->count() == 0) {
            return redirect()->back()->with('error', 'Belum ada soal untuk modul ini.');
        }

        $questions = $soal->pluck('id_kuis')->toArray();

        session(["quiz.{$id_modul}.questions" => $questions]);
        session(["quiz.{$id_modul}.current" => 0]);
        session(["quiz.{$id_modul}.score" => 0]);
        session(["quiz.{$id_modul}.answers" => []]);

        return redirect()->route('kuis.play', $id_modul);
    }

    public function play($id_modul)
    {
        $sess = session("quiz.{$id_modul}");
        if (!$sess || !isset($sess['questions'])) {
            return redirect()->route('kuis.start', $id_modul);
        }

        $questions = $sess['questions'];
        $currentIndex = $sess['current'] ?? 0;
        $total = count($questions);

        if ($currentIndex >= $total) {
            return $this->finalizeQuiz($id_modul);
        }

        $currentQuestionId = $questions[$currentIndex];
        $question = Kuis::findOrFail($currentQuestionId);

        return view('user.pertanyaan', [
            'question' => $question,
            'current' => $currentIndex + 1,
            'total' => $total,
            'id_modul' => $id_modul
        ]);
    }

    public function answer(Request $request, $id_modul)
    {
        $sess = session("quiz.{$id_modul}");
        if (!$sess || !isset($sess['questions'])) {
            return redirect()->route('kuis.start', $id_modul);
        }

        $request->validate([
            'jawaban' => 'required|in:A,B,C,D'
        ]);

        $questions = $sess['questions'];
        $currentIndex = $sess['current'] ?? 0;

        if (!isset($questions[$currentIndex])) {
            return $this->finalizeQuiz($id_modul);
        }

        $currentQuestionId = $questions[$currentIndex];
        $question = Kuis::findOrFail($currentQuestionId);

        $jawaban = $request->input('jawaban');
        $benar = ($jawaban === $question->jawaban_benar) ? 1 : 0;
        $nilaiSoal = $question->nilai ?? 0;

        $answers = $sess['answers'] ?? [];
        $answers[] = [
            'id_kuis' => $currentQuestionId,
            'jawaban' => $jawaban,
            'benar' => $benar,
            'nilai' => $benar ? $nilaiSoal : 0
        ];

        $score = ($sess['score'] ?? 0) + ($benar ? $nilaiSoal : 0);
        $currentIndex++;

        session(["quiz.{$id_modul}.answers" => $answers]);
        session(["quiz.{$id_modul}.score" => $score]);
        session(["quiz.{$id_modul}.current" => $currentIndex]);

        if ($currentIndex >= count($questions)) {
            return $this->finalizeQuiz($id_modul);
        }

        return redirect()->route('kuis.play', $id_modul);
    }

    // ===============================
    // FINALIZE QUIZ (SAVE RESULT + UPDATE PROGRESS)
    // ===============================
    protected function finalizeQuiz($id_modul)
    {
        $sess = session("quiz.{$id_modul}");
        $answers = $sess['answers'] ?? [];
        $score = $sess['score'] ?? 0;
        $jumlahBenar = collect($answers)->where('benar', 1)->count();

        $user = Pengguna::where('nama', session('nama'))->first();
        $id_pengguna = $user?->id_pengguna ?? null;

        if (!$id_pengguna) {
            return redirect()->route('login')->with('error', 'Sesi pengguna tidak ditemukan, silakan login ulang.');
        }

        $hasil = HasilKuis::create([
            'id_pengguna' => $id_pengguna,
            'id_modul' => $id_modul,
            'jumlah_benar' => $jumlahBenar,
            'skor' => $score,
            'tanggal_kerja' => now()
        ]);

        foreach ($answers as $a) {
            HasilDetail::create([
                'id_hasil' => $hasil->id_hasil,
                'id_kuis' => $a['id_kuis'],
                'jawaban_terpilih' => $a['jawaban'],
                'benar' => $a['benar']
            ]);
        }

        // ✅ Tambahkan progress update di sini
        // bersihkan session untuk modul ini
        session()->forget("quiz.{$id_modul}");

        // ✅ update status progress jadi selesai
        \App\Http\Controllers\ProgressController::saveProgress($id_modul, 'selesai');

        return redirect()->route('kuis.hasil', $hasil->id_hasil);

    }

    public function hasil($id_hasil)
    {
        $hasil = HasilKuis::with(['detail.kuis', 'pengguna'])->findOrFail($id_hasil);
        $totalSoal = $hasil->detail->count();
        $skor = $hasil->skor;
        $presentase = 0;

        if ($totalSoal > 0) {
            $maks = $hasil->detail->sum(fn($d) => $d->kuis->nilai ?? 0);
            $presentase = $maks > 0 ? round(($skor / $maks) * 100, 2) : 0;
        }

        return view('user.hasil', compact('hasil', 'totalSoal', 'skor', 'presentase'));
    }

    public function retry($id_modul)
    {
        session()->forget("quiz.{$id_modul}");
        return $this->start($id_modul);
    }
}
