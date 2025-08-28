<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RuangUserController extends Controller
{
    public function zona1()
    {
        $today = Carbon::today('Asia/Jakarta');

        $ruangs = Ruang::where('gedung_id', 1)
            ->with(['jadwals' => function ($query) use ($today) {
                $query->whereDate('tanggal', '>=', $today)
                    ->orderBy('tanggal', 'asc')
                    ->with('userAdmin'); // relasi ke admin
            }])
            ->get();

        foreach ($ruangs as $ruang) {
            // kalau ada jadwal, berarti ruangan sedang terpakai
            $ruang->status = $ruang->jadwals->isEmpty();
        }

        return view('front.ruang.zona1', compact('ruangs'));
    }

    public function field()
    {
        $today = Carbon::today('Asia/Jakarta');

        $ruangs = Ruang::where('gedung_id', 2)
            ->with(['jadwals' => function ($query) use ($today) {
                $query->whereDate('tanggal', '>=', $today)
                    ->orderBy('tanggal', 'asc')
                    ->with('userAdmin'); // relasi ke admin
            }])
            ->get();

        foreach ($ruangs as $ruang) {
            $ruang->status = $ruang->jadwals->isEmpty();
        }

        return view('front.ruang.field', compact('ruangs'));
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'ruang_id' => 'required|exists:ruangs,id',
        'penanggung_jawab' => 'required|string|max:255',
        'nama_kegiatan' => 'required|string|max:255',
        'fungsi' => 'required|string|max:255',
        'jumlah_peserta' => 'required|integer|min:1',
        'tanggal' => 'required|date',
        'fasilitas' => 'nullable|array',
        'catatan_pelaksanaan' => 'nullable|string',
    ]);

    if (isset($validated['fasilitas']) && is_array($validated['fasilitas'])) {
        $validated['fasilitas'] = json_encode($validated['fasilitas']);
    }

    // set default status
    $validated['status'] = 'pending';

    // ✅ simpan user login sebagai pembuat jadwal
    $validated['user_admin_id'] = auth()->id();

    Jadwal::create($validated);

    return redirect()->back()->with('success', 'Peminjaman berhasil diajukan dengan status Pending');
}

}
