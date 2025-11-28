<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    // 🧭 Menampilkan semua user dan role-nya
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    // ➕ Form tambah user baru
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    // 💾 Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:65',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
            'role' => 'required'
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 5 huruf.',
            'name.max' => 'Nama maksimal 65 huruf.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol khusus.',
            'role.required' => 'Role wajib dipilih.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // 🔄 Ubah role user
    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required',
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'Role user berhasil diperbarui!');
    }
}
