<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Gedung;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // Import Storage Laravel

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
        $selectedFasilitas = [];
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
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan gambar jika ada
        $imgPath = null;
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('ruangs', 'public');
        }

        $ruang = Ruang::create([
            'nama' => $validated['nama'],
            'lantai' => $validated['lantai'],
            'gedung_id' => $validated['gedung_id'],
            'img' => $imgPath,
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
        $selectedFasilitas = $ruang->fasilitas()->pluck('fasilitas.id')->toArray();
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
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan gambar baru jika ada
        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada
            if ($ruang->img && Storage::disk('public')->exists($ruang->img)) {
                Storage::disk('public')->delete($ruang->img);
            }
            $ruang->img = $request->file('img')->store('ruangs', 'public');
        }

        $ruang->nama = $validated['nama'];
        $ruang->lantai = $validated['lantai'];
        $ruang->gedung_id = $validated['gedung_id'];
        $ruang->save();

        $ruang->fasilitas()->sync($validated['fasilitas'] ?? []);

        return redirect()->route('ruangs.index')->with('success', 'Ruang berhasil diperbarui.');
    }

    public function destroy(Ruang $ruang)
    {
        // Hapus gambar jika ada
        if ($ruang->img && Storage::disk('public')->exists($ruang->img)) {
            Storage::disk('public')->delete($ruang->img);
        }

        $ruang->fasilitas()->detach();
        $ruang->delete();

        return redirect()->route('ruangs.index')->with('success', 'Ruang berhasil dihapus.');
    }

    public function getLantai($gedung_id)
    {
        $lantai = Ruang::where('gedung_id', $gedung_id)
            ->select('lantai')
            ->distinct()
            ->orderBy('lantai', 'asc')
            ->pluck('lantai');

        return response()->json($lantai);
    }

    public function getRuang($gedung_id, $lantai)
    {
        $ruang = Ruang::where('gedung_id', $gedung_id)
            ->where('lantai', $lantai)
            ->select('id', 'nama')
            ->orderBy('nama', 'asc')
            ->get();

        return response()->json($ruang);
    }

    public function history($id)
    {
        $ruang = Ruang::findOrFail($id);

        $history = $ruang->jadwals()
            ->whereDate('tanggal', '<', Carbon::today()) // hanya jadwal yang sudah lewat
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('back.ruang.history', compact('ruang', 'history'));
    }
}
