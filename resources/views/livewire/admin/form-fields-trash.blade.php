<div class="space-y-8">

    <div class="flex items-center justify-between border-b pb-4 border-gray-200 dark:border-gray-700">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">🗑️ Sampah Form Fields</h1>

        <a href="{{ route('admin.form-fields') }}"
            class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md">
            Kembali
        </a>
    </div>

    <div class="bg-white dark:bg-gray-900 dark:border-gray-700 rounded-xl shadow-md border border-gray-100 overflow-hidden mt-6">

        <table class="w-full text-sm text-gray-700 dark:text-gray-300">
            <thead class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Label</th>
                    <th class="px-4 py-3 text-left">Tipe</th>
                    <th class="px-4 py-3 text-center">Dihapus Pada</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($fields as $field)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-red-50 dark:hover:bg-gray-800 transition-all">

                        <td class="px-4 py-3 font-semibold">{{ $field->label }}</td>
                        <td class="px-4 py-3">{{ ucfirst($field->type) }}</td>

                        <td class="px-4 py-3 text-center dark:text-gray-300">
                            {{ $field->deleted_at->format('d M Y H:i') }}
                        </td>

                        <td class="px-4 py-3 text-center flex justify-center gap-3">

                            <button wire:click="restore({{ $field->id }})"
                                class="text-green-600 hover:text-green-800 font-semibold">
                                ♻️ Pulihkan
                            </button>

                            <button wire:click="forceDelete({{ $field->id }})"
                                class="text-red-600 hover:text-red-800 font-semibold">
                                ❌ Hapus Permanen
                            </button>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 italic">
                            Tidak ada data di sampah.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>
