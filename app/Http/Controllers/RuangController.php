<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Gedung;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        $ruangs = Ruang::with('gedung')->paginate(10);
        return view('back.ruang.index', compact('ruangs'));
    }

    public function create()
    {
        $gedungs = Gedung::all();
        $fasilitas = Fasilitas::all();
        $selectedFasilitas = []; // atau null
        return view('back.ruang.create', compact('gedungs', 'fasilitas', 'selectedFasilitas'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lantai' => 'required|integer',
            'gedung_id' => 'required|exists:gedungs,id',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id',
        ]);

        $ruang = Ruang::create([
            'nama' => $validated['nama'],
            'lantai' => $validated['lantai'],
            'gedung_id' => $validated['gedung_id'],
        ]);

        if (isset($validated['fasilitas'])) {
            $ruang->fasilitas()->sync($validated['fasilitas']);
        }

        return redirect()->route('ruangs.index')->with('success', 'Ruang berhasil ditambahkan.');
    }

    public function edit(Ruang $ruang)
    {
        $gedungs = Gedung::all();
        $fasilitas = Fasilitas::all();
        $selectedFasilitas = $ruang->fasilitas()->pluck('fasilitas.id')->toArray(); // fasilitas terpilih
        return view('back.ruang.edit', compact('ruang', 'gedungs', 'fasilitas', 'selectedFasilitas'));
    }

    public function update(Request $request, Ruang $ruang)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lantai' => 'required|integer',
            'gedung_id' => 'required|exists:gedungs,id',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id',
        ]);

        $ruang->update([
            'nama' => $validated['nama'],
            'lantai' => $validated['lantai'],
            'gedung_id' => $validated['gedung_id'],
        ]);

        $ruang->fasilitas()->sync($validated['fasilitas'] ?? []);

        return redirect()->route('ruangs.index')->with('success', 'Ruang berhasil diperbarui.');
    }

    public function destroy(Ruang $ruang)
    {
        $ruang->fasilitas()->detach(); // hapus relasi fasilitas terlebih dahulu
        $ruang->delete();

        return redirect()->route('ruangs.index')->with('success', 'Ruang berhasil dihapus.');
    }

    // RuangController.php
    public function getLantai($gedung_id)
    {
        $lantai = \App\Models\Ruang::where('gedung_id', $gedung_id)
                    ->select('lantai')
                    ->distinct()
                    ->orderBy('lantai', 'asc')
                    ->pluck('lantai');
        return response()->json($lantai);
    }

    public function getRuang($gedung_id, $lantai)
    {
        $ruang = \App\Models\Ruang::where('gedung_id', $gedung_id)
                    ->where('lantai', $lantai)
                    ->select('id', 'nama')
                    ->orderBy('nama', 'asc')
                    ->get();
        return response()->json($ruang);
    }

}
