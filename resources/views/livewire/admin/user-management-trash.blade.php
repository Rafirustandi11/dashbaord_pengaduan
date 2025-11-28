<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Sampah Akun Bidang') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Tombol kembali --}}
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">

                <a href="{{ route('admin.users') }}"
                    class="px-4 py-2 rounded-lg text-sm font-semibold 
                    bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 
                    text-gray-800 dark:text-gray-200">
                    Kembali
                </a>

                <button wire:click="emptyTrash"
                    onclick="return confirm('Kosongkan semua sampah?')"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow">
                    🗑️ Kosongkan Sampah
                </button>

            </div>

            {{-- Tabel --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">

                <table class="w-full text-sm text-gray-700 dark:text-gray-300">
                    <thead class="bg-gradient-to-r from-red-600 to-pink-500 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Bidang</th>
                            <th class="px-4 py-3 text-center">Dihapus Pada</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="dark:bg-gray-900">

                        @forelse ($items as $item)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-red-50 dark:hover:bg-gray-700 transition-all">

                                <td class="px-4 py-3 font-semibold">{{ $item->name }}</td>
                                <td class="px-4 py-3">{{ $item->email }}</td>
                                <td class="px-4 py-3">{{ $item->bidang }}</td>

                                <td class="px-4 py-3 text-center">
                                    {{ $item->deleted_at->format('d M Y H:i') }}
                                </td>

                                <td class="px-4 py-3 text-center flex justify-center gap-3">

                                    <button wire:click="restore({{ $item->id }})"
                                        class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-semibold">
                                        ♻️ Pulihkan
                                    </button>

                                    <button wire:click="forceDelete({{ $item->id }})"
                                        onclick="return confirm('Hapus permanen akun ini?')"
                                        class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-semibold">
                                        ❌ Hapus Permanen
                                    </button>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 italic">
                                    Tidak ada akun di dalam sampah.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
