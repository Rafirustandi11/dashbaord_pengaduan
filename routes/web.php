<?php

use App\Livewire\Admin\FormFieldsTrash;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\Pengaduan;
use App\Livewire\Admin\ProfilAdmin;
use App\Livewire\Bidang\ProfilBidang;
use App\Livewire\Bidang\DashboardBidang;
use App\Livewire\Admin\FormFieldManager;
use App\Livewire\Admin\PengaduanTrash;
use App\Livewire\Admin\HistoriPengaduan as AdminHistoriPengaduan;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Bidang\EditPengaduan;
use App\Livewire\Bidang\PengaduanBidang as BidangPengaduan; // ✅ pakai alias
use App\Livewire\Bidang\HistoriPengaduan as BidangHistoriPengaduan;
use App\Http\Controllers\PengaduanController;
use App\Livewire\PengaduanCreate;
use App\Http\Controllers\ExportController;

// =======================
// 🌐 HALAMAN UTAMA (REDIRECT LOGIN OTOMATIS)
// =======================
Route::get('/redirect-by-role', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'bidang') {
        return redirect()->route('bidang.dashboard');
    }

    return redirect()->route('dashboard');
})->name('redirect.by.role');

// =======================
// 👤 DEFAULT DASHBOARD JETSTREAM (USER UMUM)
// =======================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// =======================
// 🧱 ADMIN PANEL
// =======================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', \App\Livewire\Admin\UserManagement::class)->name('admin.users');
    Route::get('/admin/users/trash', \App\Livewire\Admin\UserManagementTrash::class)->name('admin.user-management.trash');
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/pengaduan', Pengaduan::class)->name('admin.pengaduan');
    Route::get('/admin/pengaduan/sampah', PengaduanTrash::class)->middleware('auth')->name('admin.pengaduan.trash');
    Route::get('/admin/histori-pengaduan', AdminHistoriPengaduan::class)->name('admin.histori-pengaduan');
    Route::get('/profil-admin', ProfilAdmin::class)->name('admin.profil-admin');
    Route::get('/admin/form-fields', FormFieldManager::class)->name('admin.form-fields');
    Route::get('/admin/form-fields/trash', FormFieldsTrash::class)->name('admin.form-fields.trash');
    Route::get('/admin/dashboard/export-excel', [ExportController::class, 'exportExcel'])->name('admin.dashboard.export.excel');
    Route::get('/admin/dashboard/export-pdf', [ExportController::class, 'exportPDF'])->name('admin.dashboard.export.pdf');
});

// =======================
// 🧩 BIDANG PANEL
// =======================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/bidang/dashboard', DashboardBidang::class)->name('bidang.dashboard');
    Route::get('/bidang/pengaduan', BidangPengaduan::class)->name('bidang.pengaduan');
    Route::get('/bidang/pengaduan/{id}', EditPengaduan::class)->name('bidang.pengaduan.edit');
    Route::get('/bidang/histori-pengaduan', BidangHistoriPengaduan::class)->name('bidang.histori');
    Route::get('/bidang/profil', ProfilBidang::class)->name('bidang.profil');
});

// ======================
// Pengaduan User/Warga
// ======================
Route::get('/pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan', PengaduanCreate::class)->name('pengaduan.form');



// ========================= 
// Logout 
// =========================
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 🔹 Redirect sesuai role (supaya elegan)
    if ($request->user()?->role === 'admin') {
        return redirect('/login')->with('status', 'Anda telah logout dari Admin Dashboard');
    } elseif ($request->user()?->role === 'bidang') {
        return redirect('/login')->with('status', 'Anda telah logout dari Bidang Dashboard');
    }

    return redirect('/login');
})->name('logout');
