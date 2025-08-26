<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RuangUserController extends Controller
{
    public function zona1()
    {
        $today = Carbon::today('Asia/Jakarta');

        $ruangs = Ruang::where('gedung_id', 1)
            ->with(['jadwals' => function($query) use ($today) {
                $query->whereDate('tanggal', '>=', $today) // ambil jadwal hari ini & seterusnya
                      ->orderBy('tanggal', 'asc')
                      ->with('userAdmin');
            }])
            ->get();

        foreach ($ruangs as $ruang) {
            // jika jadwal kosong → ruangan tersedia
            $ruang->status = $ruang->jadwals->isEmpty();
        }

        return view('front.ruang.zona1', compact('ruangs'));
    }

    public function field()
    {
        $today = Carbon::today('Asia/Jakarta');

        $ruangs = Ruang::where('gedung_id', 2)
            ->with(['jadwals' => function($query) use ($today) {
                $query->whereDate('tanggal', '>=', $today) // ambil jadwal hari ini & seterusnya
                      ->orderBy('tanggal', 'asc')
                      ->with('userAdmin');
            }])
            ->get();

        foreach ($ruangs as $ruang) {
            $ruang->status = $ruang->jadwals->isEmpty();
        }

        return view('front.ruang.field', compact('ruangs'));
    }
}
