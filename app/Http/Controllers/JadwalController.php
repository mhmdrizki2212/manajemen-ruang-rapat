<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['ruang', 'userAdmin'])->latest();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kegiatan', 'like', "%{$search}%")
                ->orWhere('penanggung_jawab', 'like', "%{$search}%")
                ->orWhere('fungsi', 'like', "%{$search}%")
                ->orWhere('tanggal', 'like', "%{$search}%");
            });
        }

        $jadwals = $query->paginate(10);

        return view('back.jadwal.index', compact('jadwals'));
    }


    public function create()
    {
        $ruangs = Ruang::orderBy('nama')->get();
        return view('back.jadwal.create', compact('ruangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruang_id'            => 'required|exists:ruangs,id',
            'penanggung_jawab'    => 'required|string|max:255',
            'nama_kegiatan'       => 'required|string|max:255',
            'fungsi'              => 'required|string|max:255',
            'jumlah_peserta'      => 'required|integer|min:1',
            'tanggal'             => 'required|date|after_or_equal:' . now()->toDateString(),
            'fasilitas'           => 'nullable|array',
            'fasilitas.*'         => 'string',
            'catatan_pelaksanaan' => 'nullable|string',
        ]);

        // Cek apakah ruangan sudah dipakai
        $exists = Jadwal::where('ruang_id', $request->ruang_id)
            ->whereDate('tanggal', $request->tanggal)
            ->exists();

        if ($exists) {
            return back()->withErrors(['msg' => 'Ruangan sudah digunakan pada tanggal tersebut.'])->withInput();
        }

        Jadwal::create([
            'user_admin_id'       => Auth::id(),
            'ruang_id'            => $request->ruang_id,
            'penanggung_jawab'    => $request->penanggung_jawab,
            'nama_kegiatan'       => $request->nama_kegiatan,
            'fungsi'              => $request->fungsi,
            'jumlah_peserta'      => $request->jumlah_peserta,
            'tanggal'             => $request->tanggal,
            'fasilitas'           => $request->fasilitas, // array langsung
            'catatan_pelaksanaan' => $request->catatan_pelaksanaan,
        ]);

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil disimpan!');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $ruangs = Ruang::orderBy('nama')->get();
        return view('back.jadwal.edit', compact('jadwal', 'ruangs'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'ruang_id'            => 'required|exists:ruangs,id',
            'penanggung_jawab'    => 'required|string|max:255',
            'nama_kegiatan'       => 'required|string|max:255',
            'fungsi'              => 'required|string|max:255',
            'jumlah_peserta'      => 'required|integer|min:1',
            'tanggal'             => 'required|date',
            'fasilitas'           => 'nullable|array',
            'fasilitas.*'         => 'string',
            'catatan_pelaksanaan' => 'nullable|string',
        ]);

        // Cek bentrok dengan jadwal lain
        $exists = Jadwal::where('ruang_id', $request->ruang_id)
            ->whereDate('tanggal', $request->tanggal)
            ->where('id', '!=', $jadwal->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['msg' => 'Ruangan sudah digunakan pada tanggal tersebut.'])->withInput();
        }

        $jadwal->update([
            'ruang_id'            => $request->ruang_id,
            'penanggung_jawab'    => $request->penanggung_jawab,
            'nama_kegiatan'       => $request->nama_kegiatan,
            'fungsi'              => $request->fungsi,
            'jumlah_peserta'      => $request->jumlah_peserta,
            'tanggal'             => $request->tanggal,
            'fasilitas'           => $request->fasilitas, // array langsung
            'catatan_pelaksanaan' => $request->catatan_pelaksanaan,
        ]);

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil dihapus');
    }

    public function checkJadwal(Request $request)
    {
        $request->validate([
            'ruang_id' => 'required|exists:ruangs,id',
            'tanggal'  => 'required|date',
        ]);

        $terpakai = Jadwal::where('ruang_id', $request->ruang_id)
            ->whereDate('tanggal', $request->tanggal)
            ->exists();

        return response()->json([
            'tersedia' => !$terpakai,
            'message'  => $terpakai
                ? 'Ruangan sudah digunakan pada tanggal ini.'
                : 'Ruangan tersedia pada tanggal ini.'
        ]);
    }
}
