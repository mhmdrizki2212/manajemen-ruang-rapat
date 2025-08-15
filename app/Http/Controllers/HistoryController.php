<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;
use Carbon\Carbon;

class HistoryController extends Controller
{
    /**
     * Menampilkan daftar jadwal yang sudah lewat.
     */
    public function index($ruangId)
    {
        // Ambil data ruang berdasarkan ID
        $ruang = Ruang::findOrFail($ruangId);

        // Ambil jadwal yang sudah lewat
        $history = $ruang->jadwals()
            ->with('userAdmin') // relasi ke user admin
            ->where(function ($query) {
                $query->whereDate('tanggal', '<', now()->toDateString()) // Sudah lewat harinya
                      ->orWhere(function ($query) {
                          $query->whereDate('tanggal', now()->toDateString()) // Hari ini
                                ->whereTime('jam_mulai', '<', now()->toTimeString()); // Jam mulai sudah lewat
                      });
            })
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();

        return view('back.ruang.history', compact('ruang', 'history'));
    }
}
