<div class="max-w-5xl mx-auto space-y-6">

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="p-4 bg-green-500 text-white rounded-lg shadow">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="p-4 bg-red-500 text-white rounded-lg shadow">{{ session('error') }}</div>
    @endif

    {{-- Header --}}
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6 flex items-center gap-6">
        <img src="{{ Auth::user()->profile_photo_url }}"
             class="h-24 w-24 rounded-full object-cover ring-2 ring-blue-400">

        <div>
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                {{ Auth::user()->name }}
            </h2>
            <p class="text-gray-600 dark:text-gray-300">
                Administrator Sistem Pengaduan Warga
            </p>
        </div>
    </div>

    {{-- Update Foto --}}
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Foto Profil</h3>

        <div class="flex items-center gap-4">

            {{-- Foto Preview --}}
            @if ($photoPreview)
                <img src="{{ $photoPreview }}"
                     class="h-28 w-28 rounded-full object-cover ring-2 ring-blue-500">
            @else
                <img src="{{ Auth::user()->profile_photo_url }}"
                     class="h-28 w-28 rounded-full object-cover ring-2 ring-blue-500">
            @endif

            <div>
                <input type="file" wire:model="photo" id="photo"
                       class="hidden">

                <label for="photo"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg cursor-pointer hover:bg-blue-700">
                    Pilih Foto
                </label>

                <p class="text-gray-500 dark:text-gray-300 text-sm mt-2">
                    Maksimal 2MB, format JPG/PNG.
                </p>

                @error('photo')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    {{-- Update Profil --}}
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6">
        <h3 class="text-xl font-semibold dark:text-white mb-4">Informasi Profil</h3>

        <form wire:submit.prevent="updateProfile" class="space-y-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="dark:text-gray-200">Nama</label>
                    <input type="text" wire:model="name"
                        class="w-full border dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label class="dark:text-gray-200">Email</label>
                    <input type="email" wire:model="email"
                        class="w-full border dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label class="dark:text-gray-200">Telepon</label>
                    <input type="text" wire:model="phone"
                        class="w-full border dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label class="dark:text-gray-200">Alamat</label>
                    <input type="text" wire:model="alamat"
                        class="w-full border dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>
            </div>

            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- Update Password --}}
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6">
        <h3 class="text-xl font-semibold dark:text-white mb-4">Update Password</h3>

        <form wire:submit.prevent="updatePassword" class="space-y-3">

            <div>
                <label class="dark:text-gray-200">Password Lama</label>
                <input type="password" wire:model="current_password"
                    class="w-full border dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label class="dark:text-gray-200">Password Baru</label>
                <input type="password" wire:model="new_password"
                    class="w-full border dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label class="dark:text-gray-200">Konfirmasi Password</label>
                <input type="password" wire:model="confirm_password"
                    class="w-full border dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
            </div>

            <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Update Password
            </button>

        </form>
    </div>

</div>
