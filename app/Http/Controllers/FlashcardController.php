<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    // ====== ADMIN ======
    public function index()
    {
        $flashcards = Flashcard::all();
        return view('admin.flashcard.index', compact('flashcards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_modul' => 'required',
            'id_card' => 'required',
            'kata_indo' => 'required',
            'kata_jawa' => 'required',
        ]);

        Flashcard::create($request->all());

        return redirect()->route('flashcards.index')->with('success', 'Flashcard berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_modul' => 'required',
            'id_card' => 'required',
            'kata_indo' => 'required',
            'kata_jawa' => 'required',
        ]);

        $flashcard = Flashcard::findOrFail($id);
        $flashcard->update($request->all());

        return redirect()->route('flashcards.index')->with('success', 'Flashcard berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Flashcard::findOrFail($id)->delete();
        return redirect()->route('flashcards.index')->with('success', 'Flashcard berhasil dihapus.');
    }

    // ====== USER ======
    public function showForUser()
    {
        $flashcards = Flashcard::all();
        return view('user.flashcard', compact('flashcards'));
    }
}
