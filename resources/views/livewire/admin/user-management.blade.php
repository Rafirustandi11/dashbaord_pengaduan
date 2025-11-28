<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Manajemen Akun Bidang') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alert --}}
            @if (session()->has('success'))
                <div class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 px-4 py-2 rounded-md shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Header --}}
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    Daftar Akun Bidang
                </h3>

                <button wire:click="resetForm"
                    class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600
                    text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-all duration-200">
                    + Tambah Akun
                </button>
            </div>

            {{-- Form --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                        <input type="text" wire:model="name"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 
                            dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" wire:model="email"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 
                            dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bidang</label>
                        <input type="text" wire:model="bidang"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 
                            dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input type="password" wire:model="password" placeholder="Kosongkan jika tidak diubah"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 
                            dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    @if ($editMode)
                        <button wire:click="update"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                            Perbarui
                        </button>
                    @else
                        <button wire:click="store"
                            class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600
                            text-white font-semibold px-4 py-2 rounded-lg shadow">
                            Simpan
                        </button>
                    @endif

                    <button wire:click="resetForm"
                        class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 
                        text-gray-700 dark:text-gray-200 font-semibold px-4 py-2 rounded-lg shadow">
                        Batal
                    </button>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">

                <div class="flex justify-end p-3 border-b dark:border-gray-700">
                    <a href="{{ route('admin.user-management.trash') }}"
                        class="px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition
                        bg-red-500 hover:bg-red-600 text-white shadow-md">
                        🗑️ Sampah
                    </a>
                </div>

                <table class="w-full text-sm text-gray-700 dark:text-gray-300">
                    <thead class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Bidang</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="dark:bg-gray-900">
                        @forelse($users as $u)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all">

                                <td class="px-4 py-3 font-semibold">{{ $u->name }}</td>
                                <td class="px-4 py-3">{{ $u->email }}</td>
                                <td class="px-4 py-3">{{ $u->bidang }}</td>

                                <td class="px-4 py-3 text-center flex justify-center gap-2">

                                    <button wire:click="edit({{ $u->id }})"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                                        ✏️
                                    </button>

                                    <button wire:click="resetPassword({{ $u->id }})"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">
                                        🔄
                                    </button>

                                    <button wire:click="delete({{ $u->id }})"
                                        onclick="return confirm('Yakin ingin menghapus akun ini?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">
                                        🗑️
                                    </button>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 italic">
                                    Belum ada akun bidang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
