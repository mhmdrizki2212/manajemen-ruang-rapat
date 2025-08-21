<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JadwalUserController extends Controller
{
    // Menampilkan form
    public function create()
    {
        $ruangs = Ruang::orderBy('nama')->get(); // ambil semua ruangan
        return view('front.jadwal.formpinjam', compact('ruangs'));
    }

    // Menyimpan jadwal
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'ruang_id' => 'required|exists:ruangs,id',
            'nama_kegiatan' => 'required|string|max:255',
            'fungsi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'jumlah_peserta' => 'required|integer|min:1',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        // Cek konflik jadwal
        $conflict = Jadwal::where('ruang_id', $request->ruang_id)
            ->whereDate('tanggal', $request->tanggal)
            ->where(function($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhere(function($q) use ($request) {
                          $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                      });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['ruang_id' => 'Ruang sudah terpakai pada jam yang dipilih.'])->withInput();
        }

        // Simpan jadwal
        Jadwal::create([
            'user_admin_id' => Auth::id(), // user login
            'ruang_id' => $request->ruang_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'fungsi' => $request->fungsi,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal.create')->with('success', 'Jadwal berhasil dibuat!');
    }
}
    