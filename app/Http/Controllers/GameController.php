<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemoryCard;
use App\Http\Controllers\ProgressController;

class GameController extends Controller
{
    // ====== ADMIN ======
    public function index()
    {
        $cards = MemoryCard::all();
        return view('admin.game.index', compact('cards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_modul' => 'required|integer',
            'id_card'  => 'required|integer|unique:memory_cards,id_card',
            'word'     => 'required|string|max:255',
            'pair_id'  => 'required|integer',
        ]);

        MemoryCard::create($request->only(['id_modul','id_card','word','pair_id']));

        return redirect()->route('game.index')->with('success', 'Kartu berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_modul' => 'required|integer',
            'word'     => 'required|string|max:255',
            'pair_id'  => 'required|integer',
        ]);

        // Cari berdasarkan id_card, bukan id
        $card = MemoryCard::where('id_card', $id)->firstOrFail();

        $card->update($request->only(['id_modul','word','pair_id']));

        return redirect()->route('game.index')->with('success', 'Kartu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari berdasarkan id_card
        $card = MemoryCard::where('id_card', $id)->firstOrFail();

        // Hapus kartu
        $card->delete();

        return redirect()->route('game.index')->with('success', 'Kartu berhasil dihapus.');
    }

    // ====== USER ======
    public function showForUser()
    {
        $cards = MemoryCard::all();
        return view('user.game', compact('cards'));
    }

    public function showByModule($modulId)
    {
        $cards = MemoryCard::where('id_modul', $modulId)->get();

        // ✅ Simpan progress saat game dimainkan
        ProgressController::saveProgress($modulId, 'selesai');

        return view('user.game', compact('cards', 'modulId'));
    }
}
