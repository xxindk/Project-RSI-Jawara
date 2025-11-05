<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reflection;

class ReflectionController extends Controller
{
    public function index()
    {
        return view('reflection');
    }

    public function store(Request $request)
    {
        $request->validate([
            'modul' => 'required',
            'isi_refleksi' => 'required|min:3',
        ], [
            'isi_refleksi.required' => 'Refleksi tidak valid, harap isi kembali!',
            'isi_refleksi.min' => 'Refleksi terlalu singkat!',
        ]);

        Reflection::create([
            'modul' => $request->modul,
            'isi_refleksi' => $request->isi_refleksi,
        ]);

        return redirect()
            ->route('reflection.list')
            ->with('success', 'Refleksi berhasil disimpan!');
    }

    public function list()
    {
        $reflections = Reflection::all();
        return view('reflection-list', compact('reflections'));
    }

    public function edit($id)
    {
        $reflection = Reflection::findOrFail($id);
        return view('reflection', compact('reflection'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'modul' => 'required',
            'isi_refleksi' => 'required|min:3',
        ], [
            'isi_refleksi.required' => 'Refleksi tidak valid, harap isi kembali.',
        ]);

        $reflection = Reflection::findOrFail($id);

        $reflection->update([
            'modul' => $request->modul,
            'isi_refleksi' => $request->isi_refleksi
        ]);

        return redirect()
            ->route('reflection.list')
            ->with('success', 'Refleksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $reflection = Reflection::findOrFail($id);
        $reflection->delete();

        return redirect()
            ->route('reflection.list')
            ->with('success', 'Refleksi berhasil dihapus!');
    }
}
