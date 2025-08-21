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
        $startTime = '05:00:00';
        $endTime = '17:00:00';

        $ruangs = Ruang::where('gedung_id', 1)
            ->with(['jadwals' => function($query) use ($today, $startTime, $endTime) {
                $query->whereDate('tanggal', $today)
                      ->whereTime('jam_selesai', '>=', $startTime)
                      ->whereTime('jam_mulai', '<=', $endTime)
                      ->orderBy('jam_mulai', 'asc')
                      ->with('userAdmin');
            }])
            ->get();

        foreach ($ruangs as $ruang) {
            $ruang->status = $ruang->jadwals->isEmpty(); // true jika kosong
        }

        return view('front.ruang.zona1', compact('ruangs'));
    }

    public function field()
    {
        $today = Carbon::today('Asia/Jakarta');
        $startTime = '05:00:00';
        $endTime = '17:00:00';

        $ruangs = Ruang::where('gedung_id', 2)
            ->with(['jadwals' => function($query) use ($today, $startTime, $endTime) {
                $query->whereDate('tanggal', $today)
                      ->whereTime('jam_selesai', '>=', $startTime)
                      ->whereTime('jam_mulai', '<=', $endTime)
                      ->orderBy('jam_mulai', 'asc')
                      ->with('userAdmin');
            }])
            ->get();

        foreach ($ruangs as $ruang) {
            $ruang->status = $ruang->jadwals->isEmpty(); // true jika kosong
        }

        return view('front.ruang.field', compact('ruangs'));
    }
}
