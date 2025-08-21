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
        $today = Carbon::today('Asia/Jakarta');

        // 🔹 Statistik User & Ruang
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        $totalRuang = Ruang::count();

        // 🔹 Total jadwal yang akan datang (hanya lihat tanggal > hari ini)
        $totalUpcomingJadwal = Jadwal::whereDate('tanggal', '>', $today)->count();

        // 🔹 Ruang terpakai hari ini (distinct by ruang_id)
        $totalRuangTerpakaiHariIni = Jadwal::whereDate('tanggal', $today)
            ->distinct('ruang_id')
            ->count('ruang_id');

        // 🔹 Data jadwal hari ini
        $jadwals = Jadwal::with(['ruang', 'userAdmin'])
            ->whereDate('tanggal', $today)
            ->orderBy('tanggal', 'asc')
            ->paginate(10);

        // 🔹 Tambahkan kolom status (lebih sederhana, karena tanpa jam)
        $jadwals->getCollection()->transform(function ($jadwal) use ($today) {
            if ($jadwal->tanggal == $today->toDateString()) {
                $jadwal->status = 'Sedang Berlangsung';
            } elseif ($jadwal->tanggal > $today->toDateString()) {
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
