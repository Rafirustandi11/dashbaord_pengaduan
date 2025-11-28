<div class="max-w-4xl space-y-6 mx-auto">
    {{-- Profile Header --}}
    <div class="bg-white shadow-sm rounded-xl p-6">
        <div class="flex items-center gap-6">
            <div class="h-24 w-24 rounded-full bg-blue-600 text-white flex items-center justify-center text-4xl font-semibold">
                A
            </div>
            <div class="flex-1">
                <h2 class="text-2xl mb-1">Administrator</h2>
                <p class="text-gray-500 mb-3">Bidang - Sistem Pengaduan</p>
                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Edit Foto</button>
                    <button class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100">Hapus Foto</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Informasi Dasar --}}
    <div class="bg-white shadow-sm rounded-xl p-6">
        <div class="mb-6">
            <h3 class="text-xl mb-1 font-semibold">Informasi Dasar</h3>
            <p class="text-gray-500">Kelola informasi profil Anda</p>
        </div>

        <form class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="nama" class="font-medium">Nama Lengkap</label>
                    <div class="relative">
                        <input type="text" id="nama" value="Bidang" class="w-full pl-10 pr-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a6 6 0 0 1 12 0v2"/></svg>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="email" class="font-medium">Email</label>
                    <div class="relative">
                        <input type="email" id="email" value="bidang@example.com" class="w-full pl-10 pr-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="phone" class="font-medium">Nomor Telepon</label>
                    <div class="relative">
                        <input type="text" id="phone" value="+62 8224-6927-861" class="w-full pl-10 pr-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92V21a2 2 0 0 1-2.18 2 19.88 19.88 0 0 1-8.63-3.07A19.5 19.5 0 0 1 2 5.18 2 2 0 0 1 4 3h4.09a2 2 0 0 1 2 1.72c.12.81.31 1.6.56 2.37a2 2 0 0 1-.45 2L9 10a16 16 0 0 0 6 6l.91-.19a2 2 0 0 1 2 1.72z"/></svg>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="role" class="font-medium">Role</label>
                    <div class="relative">
                        <input type="text" id="role" value="bidang" disabled class="w-full pl-10 pr-3 py-2 border rounded-lg bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 12l8-4-8-4-8 4 8 4z"/><path d="M12 12v8"/></svg>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label for="alamat" class="font-medium">Alamat</label>
                <textarea id="alamat" rows="3" class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-200">Jl.Brigden Dharsono No A1/04 Kota Cirebon</textarea>
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan Perubahan</button>
                <button type="button" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-100">Batal</button>
            </div>
        </form>
    </div>

    {{-- Keamanan Akun --}}
    <div class="bg-white shadow-sm rounded-xl p-6">
        <div class="mb-6">
            <h3 class="text-xl mb-1 font-semibold">Keamanan Akun</h3>
            <p class="text-gray-500">Kelola password dan keamanan akun</p>
        </div>

        <form class="space-y-4">
            <div>
                <label for="current-password" class="font-medium">Password Saat Ini</label>
                <input type="password" id="current-password" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label for="new-password" class="font-medium">Password Baru</label>
                <input type="password" id="new-password" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label for="confirm-password" class="font-medium">Konfirmasi Password Baru</label>
                <input type="password" id="confirm-password" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update Password</button>
                <button type="button" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-100">Batal</button>
            </div>
        </form>
    </div>

    {{-- Informasi Akun --}}
    <div class="bg-white shadow-sm rounded-xl p-6">
        <div class="mb-6">
            <h3 class="text-xl mb-1 font-semibold">Informasi Akun</h3>
            <p class="text-gray-500">Detail tentang akun Anda</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                <div>
                    <p class="text-sm text-gray-500">Bergabung Sejak</p>
                    <p>1 Januari 2024</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4l2-2"/></svg>
                <div>
                    <p class="text-sm text-gray-500">Tingkat Akses</p>
                    <p>Full Access - Administrator</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a6 6 0 0 1 12 0v2"/></svg>
                <div>
                    <p class="text-sm text-gray-500">Terakhir Login</p>
                    <p>20 Oktober 2024, 14:30 WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>
