<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalUserController extends Controller
{
    /**
     * Simpan request jadwal dari user
     */
    public function store(Request $request)
    {
        $request->validate([
            'ruang_id' => 'required|exists:ruangs,id',
            'penanggung_jawab' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'fungsi' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer',
            'tanggal' => 'required|date',
            'fasilitas' => 'required|string|max:255',
            'catatan_pelaksanaan' => 'nullable|string|max:500',
        ]);

        Jadwal::create([
            'ruang_id' => $request->ruang_id,
            'user_id' => auth()->id(),   // user yang mengajukan request
            'penanggung_jawab' => $request->penanggung_jawab,
            'nama_kegiatan' => $request->nama_kegiatan,
            'fungsi' => $request->fungsi,
            'jumlah_peserta' => $request->jumlah_peserta,
            'tanggal' => $request->tanggal,
            'fasilitas' => $request->fasilitas,
            'catatan_pelaksanaan' => $request->catatan_pelaksanaan,
            'status' => 'pending',       // otomatis pending
        ]);

        return redirect()->back()->with('success', 'Request berhasil dikirim, menunggu persetujuan admin.');
    }
}
