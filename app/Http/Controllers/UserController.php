<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jadwal; // ✅ huruf "A" besar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ✅ Tampilkan semua user
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pendingCount = Jadwal::where('status', 'pending')->count();

    
        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest() // Menampilkan user terbaru di atas
            ->paginate(7)
            ->withQueryString(); // Penting agar parameter 'search' tetap ada saat pindah halaman

              // Jika hasil pencarian kosong dan ada input pencarian
            if ($search && $users->total() == 0) {
                return redirect()->route('users.index')->with('not_found', 'User/Admin dengan nama atau email "' . $search . '" tidak ditemukan.');
            }
    
        return view('back.users.index', compact('users', 'search' ,'pendingCount'));
    }
    


    // ✅ Form tambah user
    public function create()
    {
        $pendingCount = Jadwal::where('status', 'pending')->count();

        return view('back.users.create', compact('pendingCount'));
    }

    // ✅ Proses simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'role'     => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // ✅ Form edit user
    public function edit(User $user)
    {
        $pendingCount = Jadwal::where('status', 'pending')->count();

        return view('back.users.edit', compact('user' , 'pendingCount'));
    }

    // ✅ Proses update user
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,user',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);
    
        $user->name = $validated['name'];
        $user->role = $validated['role'];
        $user->email = $validated['email'];
    
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }
    

    // ✅ Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
