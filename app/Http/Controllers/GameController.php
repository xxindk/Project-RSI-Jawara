<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemoryCard;

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
            'id_card'  => 'required|integer',
            'word'     => 'required|string|max:255',
            'pair_id'  => 'required|integer',
        ]);

        $card = MemoryCard::findOrFail($id);
        $card->update($request->only(['id_modul','id_card','word','pair_id']));

        return redirect()->route('game.index')->with('success', 'Kartu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        MemoryCard::findOrFail($id)->delete();
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
        return view('user.game', compact('cards', 'modulId'));
    }
}
