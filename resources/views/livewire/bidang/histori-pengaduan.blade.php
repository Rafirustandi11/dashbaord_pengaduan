<div class="p-6 bg-gray-50 min-h-screen">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Histori Pengaduan Bidang</h1>

    <div class="bg-white p-4 rounded-lg shadow">
        <table class="table-auto w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Pelapor</th>
                    <th class="px-4 py-2 text-left">Kategori</th>
                    <th class="px-4 py-2 text-left">Bidang Tujuan</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Diperbarui</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($histori as $item)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $item->nama_warga ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->kategori }}</td>
                        <td class="px-4 py-2 capitalize">{{ $item->bidang_tujuan ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <span
                                class="px-2 py-1 text-sm rounded
                                @if ($item->status === 'Selesai') @elseif($item->status === 'Proses') bg-yellow-200
                                @else text-gray-800 @endif">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-gray-500">{{ $item->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada histori pengaduan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
