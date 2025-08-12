<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Ruang;
use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with(['ruang', 'userAdmin'])->latest()->paginate(10);
        return view('back.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $gedungs = Gedung::all(); // Pastikan punya model Gedung
        return view('back.jadwal.create', compact('gedungs'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_kegiatan' => 'required',
        'fungsi' => 'required',
        'tanggal' => [
            'required',
            'date',
            'after_or_equal:' . now()->toDateString(),
        ],
        'jam_mulai' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->tanggal == now()->toDateString() && $value < now()->format('H:i')) {
                    $fail('Jam mulai tidak boleh kurang dari waktu sekarang.');
                }
            }
        ],
        'jam_selesai' => [
            'required',
            'after_or_equal:jam_mulai',
        ],
        'ruang_id' => 'required'
    ]);

    Jadwal::create([
        'user_admin_id' => Auth::id(),
        'ruang_id' => $request->ruang_id,
        'nama_kegiatan' => $request->nama_kegiatan,
        'fungsi' => $request->fungsi,
        'tanggal' => $request->tanggal,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
    ]);

    return redirect()
        ->route('jadwals.index')
        ->with('success', 'Jadwal berhasil disimpan!');
}

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $gedungs = Gedung::all();
        return view('back.jadwal.edit', compact('jadwal', 'gedungs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'fungsi' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang_id' => 'required'
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'ruang_id' => $request->ruang_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'fungsi' => $request->fungsi,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil dihapus');
    }

    // Untuk AJAX
    public function getRuangs($gedungId)
    {
        $ruangs = Ruang::where('gedung_id', $gedungId)->get();
        return response()->json($ruangs);
    }
}
