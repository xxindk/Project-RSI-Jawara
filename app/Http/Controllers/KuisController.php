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
    // ADMIN: daftar kuis (semua atau per modul)
    public function index()
    {
        $kuis = Kuis::with('modul')->orderBy('id_modul')->paginate(15);
        return view('admin.kuis.index', compact('kuis'));
    }

    // ADMIN: form create
    public function create()
    {
        $moduls = Modul::where('status',1)->orderBy('nomor_urut')->get();
        return view('admin.kuis.form', ['kuis' => new Kuis(), 'moduls' => $moduls, 'method' => 'POST', 'action' => route('kuis.store')]);
    }

    // ADMIN: simpan soal
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
        return redirect()->route('kuis.index')->with('success','Soal kuis berhasil dibuat.');
    }

    // ADMIN: edit
    public function edit($id)
    {
        $kuis = Kuis::findOrFail($id);
        $moduls = Modul::where('status',1)->orderBy('nomor_urut')->get();
        return view('admin.kuis.form', ['kuis'=>$kuis, 'moduls'=>$moduls, 'method'=>'PUT', 'action'=>route('kuis.update', $kuis->id_kuis)]);
    }

    // ADMIN: update
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
        return redirect()->route('kuis.index')->with('success','Soal kuis berhasil diperbarui.');
    }

    // ADMIN: delete
    public function destroy($id)
    {
        $kuis = Kuis::findOrFail($id);
        $kuis->delete();
        return redirect()->route('kuis.index')->with('success','Soal kuis berhasil dihapus.');
    }

    /* ============================
       USER FLOW: start -> play -> answer -> hasil
       ============================ */

    // start: ambil soal untuk modul, acak, simpan di session
    public function start($id_modul)
    {
        $soal = Kuis::where('id_modul', $id_modul)->inRandomOrder()->limit(10)->get();

        if ($soal->count() == 0) {
            return redirect()->back()->with('error','Belum ada soal untuk modul ini.');
        }

        $questions = $soal->pluck('id_kuis')->toArray();

        // simpan di session per modul
        session(["quiz.{$id_modul}.questions" => $questions]);
        session(["quiz.{$id_modul}.current" => 0]);
        session(["quiz.{$id_modul}.score" => 0]);
        session(["quiz.{$id_modul}.answers" => []]);

        return redirect()->route('kuis.play', $id_modul);
    }

    // play: tampilkan pertanyaan saat ini
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
            // sudah selesai
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

    // answer: proses jawaban user (post)
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

// jika sudah melewati jumlah soal, langsung ke finalize
if (!isset($questions[$currentIndex])) {
    return $this->finalizeQuiz($id_modul);
}

$currentQuestionId = $questions[$currentIndex];
$question = Kuis::findOrFail($currentQuestionId);

        $jawaban = $request->input('jawaban');
        $benar = ($jawaban === $question->jawaban_benar) ? 1 : 0;
        $nilaiSoal = $question->nilai ?? 0;

        // simpan jawaban di session
        $answers = $sess['answers'] ?? [];
        $answers[] = [
            'id_kuis' => $currentQuestionId,
            'jawaban' => $jawaban,
            'benar' => $benar,
            'nilai' => $benar ? $nilaiSoal : 0
        ];

        // update score & current
        $score = ($sess['score'] ?? 0) + ($benar ? $nilaiSoal : 0);
        $currentIndex++;

        session(["quiz.{$id_modul}.answers" => $answers]);
        session(["quiz.{$id_modul}.score" => $score]);
        session(["quiz.{$id_modul}.current" => $currentIndex]);

        // if finished, finalize
        if ($currentIndex >= count($questions)) {
            return $this->finalizeQuiz($id_modul);
        }

        return redirect()->route('kuis.play', $id_modul);
    }

    // finalize: simpan hasil ke DB dan arahkan ke halaman hasil
    protected function finalizeQuiz($id_modul)
    {
        $sess = session("quiz.{$id_modul}");
        $answers = $sess['answers'] ?? [];
        $score = $sess['score'] ?? 0;
        $jumlahBenar = collect($answers)->where('benar',1)->count();

      // Ambil id pengguna dari session login
$user = Pengguna::where('nama', session('nama'))->first();
$id_pengguna = $user?->id_pengguna ?? null;

if (!$id_pengguna) {
    return redirect()->route('login')->with('error', 'Sesi pengguna tidak ditemukan, silakan login ulang.');
}


        // simpan hasil ke DB
        $hasil = HasilKuis::create([
            'id_pengguna' => $id_pengguna,
            'id_modul' => $id_modul,
            'jumlah_benar' => $jumlahBenar,
            'skor' => $score,
            'tanggal_kerja' => now()
        ]);

        // simpan detail per soal
        foreach ($answers as $a) {
            HasilDetail::create([
                'id_hasil' => $hasil->id_hasil,
                'id_kuis' => $a['id_kuis'],
                'jawaban_terpilih' => $a['jawaban'],
                'benar' => $a['benar']
            ]);
        }

        // bersihkan session untuk modul ini
        session()->forget("quiz.{$id_modul}");

        return redirect()->route('kuis.hasil', $hasil->id_hasil);
    }

    // hasil: tampilkan halaman hasil
    public function hasil($id_hasil)
    {
        $hasil = HasilKuis::with(['detail.kuis','pengguna'])->findOrFail($id_hasil);
        $totalSoal = $hasil->detail->count();
        $skor = $hasil->skor;
        $presentase = 0;
        if ($totalSoal > 0) {
            // hitung maksimal skor: jumlah soal * nilai tiap soal (ambil per detail via hubungan)
            $maks = $hasil->detail->sum(function($d){
                return $d->kuis->nilai ?? 0;
            });
            $presentase = $maks > 0 ? round(($skor / $maks) * 100, 2) : 0;
        }

        return view('user.hasil', compact('hasil','totalSoal','skor','presentase'));
    }

    // retry: mulai ulang (sama seperti start)
    public function retry($id_modul)
    {
        // hapus session jika ada lalu start ulang
        session()->forget("quiz.{$id_modul}");
        return $this->start($id_modul);
    }
}
