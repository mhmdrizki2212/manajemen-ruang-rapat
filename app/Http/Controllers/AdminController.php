<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ruang;
use App\Models\Jadwal;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $now = Carbon::now('Asia/Jakarta');
        $today = Carbon::today('Asia/Jakarta');

        // 🔹 Statistik User & Ruang
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        $totalRuang = Ruang::count();

        // 🔹 Total jadwal yang akan datang
        $totalUpcomingJadwal = Jadwal::where(function ($query) use ($now) {
                $query->whereDate('tanggal', $now->toDateString())
                      ->whereTime('jam_mulai', '>', $now->toTimeString());
            })
            ->orWhereDate('tanggal', '>', $now->toDateString())
            ->count();

        // 🔹 Ruang terpakai hari ini (sedang berlangsung)
        $totalRuangTerpakaiHariIni = Jadwal::whereDate('tanggal', $today)
        ->distinct('ruang_id')
        ->count('ruang_id');
    

        // 🔹 Data jadwal hari ini (pakai paginate supaya bisa di-blade dengan links())
        $jadwals = Jadwal::with(['ruang', 'userAdmin'])
            ->whereDate('tanggal', $today)
            ->orderBy('jam_mulai', 'asc')
            ->paginate(10); // <= gunakan pagination

        // 🔹 Tambahkan kolom status (manual, tidak di DB)
        $jadwals->getCollection()->transform(function ($jadwal) use ($now) {
            if ($jadwal->jam_mulai <= $now->format('H:i:s') && $jadwal->jam_selesai >= $now->format('H:i:s')) {
                $jadwal->status = 'Sedang Berlangsung';
            } elseif ($jadwal->jam_mulai > $now->format('H:i:s')) {
                $jadwal->status = 'Belum Dimulai';
            } else {
                $jadwal->status = 'Selesai';
            }
            return $jadwal;
        });
        

        // 🔹 Kirim ke view
        return view('back.home-admin', compact(
            'totalUsers',
            'totalAdmins',
            'totalRegularUsers',
            'totalRuang',
            'totalUpcomingJadwal',
            'totalRuangTerpakaiHariIni',
            'jadwals'
        ));
    }
}
