<div>

    {{-- 🔥 TOMBOL ATAS --}} 
    <div class="flex items-center justify-between border-b pb-4 mb-4">

        <div class="flex gap-3">

            {{-- Pengaduan Aktif --}}
            <a href="{{ route('admin.pengaduan') }}"
                class="px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2
                {{ request()->routeIs('admin.pengaduan')
                    ? 'bg-indigo-600 text-white shadow-md'
                    : 'bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-all duration-200' }}">
                Kembali
            </a>

        </div>

        {{-- Tombol Kosongkan Sampah --}}
        <button wire:click="emptyTrash"
            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-md text-sm"
            onclick="return confirm('Kosongkan semua sampah? Tindakan ini permanen!')">
            🗑️ Kosongkan Sampah
        </button>
    </div>


    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden mt-6">

        <table class="w-full text-sm text-gray-700">
            <thead class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Nama Warga</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Dihapus Pada</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($items as $item)
                    <tr class="border-b hover:bg-red-50 transition-all">

                        <td class="px-4 py-3 font-semibold">
                            {{ $item->nama_warga }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $item->kategori }}
                        </td>

                        <td class="px-4 py-3">
                            {{ ucfirst($item->status) }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            {{ $item->deleted_at ? $item->deleted_at->format('d M Y H:i') : '-' }}
                        </td>

                        <td class="px-4 py-3 text-center flex justify-center gap-3">

                            {{-- Restore --}}
                            <button wire:click="restore({{ $item->id }})"
                                class="text-green-600 hover:text-green-800 font-semibold">
                                ♻️ Pulihkan
                            </button>

                            {{-- Delete Permanen --}}
                            <button wire:click="forceDelete({{ $item->id }})"
                                onclick="return confirm('Hapus permanen laporan ini?')"
                                class="text-red-600 hover:text-red-800 font-semibold">
                                ❌ Hapus Permanen
                            </button>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 italic">
                            Tidak ada pengaduan di dalam sampah.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
