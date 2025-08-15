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

        // Hitung jumlah semua user
        $totalUsers = User::count();

        // Hitung jumlah admin
        $totalAdmins = User::where('role', 'admin')->count();

        // Hitung jumlah user biasa
        $totalRegularUsers = User::where('role', 'user')->count();

        // Hitung jumlah ruang
        $totalRuang = Ruang::count();

        // Hitung jadwal akan datang
        $totalUpcomingJadwal = Jadwal::where(function($query) use ($now) {
                // Jadwal hari ini, jam mulai harus lebih dari sekarang
                $query->whereDate('tanggal', $now->toDateString())
                      ->whereTime('jam_mulai', '>', $now->toTimeString());
            })
            ->orWhereDate('tanggal', '>', $now->toDateString()) // Jadwal di masa depan
            ->count();

        // Kirim semua variabel ke view
        return view('back.home-admin', compact(
            'totalUsers',
            'totalAdmins',
            'totalRegularUsers',
            'totalRuang',
            'totalUpcomingJadwal'
        ));
    }
}
