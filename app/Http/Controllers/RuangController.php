<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RuangController extends Controller
{
    public function index(Request $request)
    {
        $query = Ruang::with('gedung');

        // filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('lantai', 'like', "%{$search}%")
                ->orWhereHas('gedung', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%{$search}%");
                });
            });
        }

        $ruangs = $query->paginate(10);

        return view('back.ruang.index', compact('ruangs'));
    }


    public function create()
    {
        $gedungs = Gedung::all();
        return view('back.ruang.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lantai' => 'required|integer',
            'gedung_id' => 'required|exists:gedungs,id',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan gambar jika ada
        $imgPath = null;
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('ruangs', 'public');
        }

        Ruang::create([
            'nama' => $validated['nama'],
            'lantai' => $validated['lantai'],
            'gedung_id' => $validated['gedung_id'],
            'img' => $imgPath,
        ]);

        return redirect()->route('ruangs.index')->with('success', 'Ruang berhasil ditambahkan.');
    }

    public function edit(Ruang $ruang)
    {
        $gedungs = Gedung::all();
        return view('back.ruang.edit', compact('ruang', 'gedungs'));
    }

    public function update(Request $request, Ruang $ruang)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lantai' => 'required|integer',
            'gedung_id' => 'required|exists:gedungs,id',
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

        return redirect()->route('ruangs.index')->with('success', 'Ruang berhasil diperbarui.');
    }

    public function destroy(Ruang $ruang)
    {
        // Hapus gambar jika ada
        if ($ruang->img && Storage::disk('public')->exists($ruang->img)) {
            Storage::disk('public')->delete($ruang->img);
        }

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
            ->whereDate('tanggal', '<', Carbon::today())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('back.ruang.history', compact('ruang', 'history'));
    }
}
