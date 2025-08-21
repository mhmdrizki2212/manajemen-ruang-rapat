<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;

class HistoryController extends Controller
{
    /**
     * Menampilkan daftar jadwal yang sudah lewat berdasarkan ruang.
     */
    public function index($ruangId)
    {
        $today = now()->toDateString();

        // Ambil data ruang
        $ruang = Ruang::findOrFail($ruangId);

        // Ambil history jadwal (semua jadwal sebelum hari ini)
        $history = $ruang->jadwals()
            ->with(['userAdmin', 'ruang']) // relasi tambahan jika perlu
            ->whereDate('tanggal', '<', $today)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('back.ruang.history', compact('ruang', 'history'));
    }
}
