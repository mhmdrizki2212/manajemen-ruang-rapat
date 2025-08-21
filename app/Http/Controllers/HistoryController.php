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
        $currentTime = now()->toTimeString();

        // Ambil data ruang
        $ruang = Ruang::findOrFail($ruangId);

        // Ambil history jadwal (sudah lewat hari atau jam mulai lewat hari ini)
        $history = $ruang->jadwals()
            ->with(['userAdmin', 'ruang']) // kalau perlu info ruang juga
            ->where(function ($query) use ($today, $currentTime) {
                $query->whereDate('tanggal', '<', $today) // jadwal sebelum hari ini
                      ->orWhere(function ($q) use ($today, $currentTime) {
                          $q->whereDate('tanggal', $today)
                            ->whereTime('jam_mulai', '<', $currentTime);
                      });
            })
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();

        return view('back.ruang.history', compact('ruang', 'history'));
    }
}
