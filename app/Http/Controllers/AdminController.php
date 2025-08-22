<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ruang;
use App\Models\Jadwal;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today('Asia/Jakarta');

        // 🔹 Ambil filter tanggal (kalau tidak ada pakai default bulan ini)
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate   = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        // 🔹 Statistik User & Ruang
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        $totalRuang = Ruang::count();

        // 🔹 Total jadwal yang akan datang
        $totalUpcomingJadwal = Jadwal::whereDate('tanggal', '>', $today)->count();

        // 🔹 Ruang terpakai hari ini
        $totalRuangTerpakaiHariIni = Jadwal::whereDate('tanggal', $today)
            ->distinct('ruang_id')
            ->count('ruang_id');

        // 🔹 Ruang tidak terpakai hari ini
        $totalRuangTidakTerpakaiHariIni = $totalRuang - $totalRuangTerpakaiHariIni;

        // 🔹 Data jadwal hari ini
        $jadwals = Jadwal::with(['ruang', 'userAdmin'])
            ->whereDate('tanggal', $today)
            ->orderBy('tanggal', 'asc')
            ->paginate(10);

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

        // 🔹 Data grafik (filter berdasarkan rentang tanggal)
        $ruangan = Ruang::all();

        $chartLabels = [];
        $chartPemakaian = [];
        $chartPeserta = [];

        foreach ($ruangan as $r) {
            $chartLabels[] = $r->nama;

            // Jumlah pemakaian ruang dalam range tanggal
            $chartPemakaian[] = Jadwal::where('ruang_id', $r->id)
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->count();

            // Jumlah peserta total dalam range tanggal
            $chartPeserta[] = Jadwal::where('ruang_id', $r->id)
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->sum('jumlah_peserta');
        }

        return view('back.home-admin', compact(
            'totalUsers',
            'totalAdmins',
            'totalRegularUsers',
            'totalRuang',
            'totalUpcomingJadwal',
            'totalRuangTerpakaiHariIni',
            'totalRuangTidakTerpakaiHariIni',
            'jadwals',
            'chartLabels',
            'chartPemakaian',
            'chartPeserta',
            'startDate',
            'endDate'
        ));
    }
}
