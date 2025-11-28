<div class="p-6">
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            Pengaduan Bidang <span class="text-indigo-600">{{ strtoupper(Auth::user()->bidang) }}</span>
        </h2>
        <p class="text-sm text-gray-500 mt-1">Daftar laporan warga yang ditujukan untuk bidang ini.</p>
    </x-slot>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Warga</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Isi Laporan</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="p-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($pengaduans as $p)
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="p-3 text-sm text-gray-800">{{ $p->nama_warga }}</td>
                        <td class="p-3 text-sm text-gray-800">{{ $p->kategori ?? '-' }}</td>
                        <td class="p-3 text-sm text-gray-700">{{ Str::limit($p->isi_laporan, 60) }}</td>
                        <td class="p-3 text-sm">
                            <x-status-badge :status="$p->status" />
                        </td>
                        <td class="p-3 text-center">
                            <div class="flex justify-center gap-2">
                                <button wire:click="openModal({{ $p->id }})"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs shadow">
                                    💬 Tanggapi
                                </button>
                                @if ($p->status !== 'Selesai')
                                    <button wire:click="ubahStatus({{ $p->id }}, 'Proses')"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs shadow">
                                        ▶️ Proses
                                    </button>
                                    <button wire:click="ubahStatus({{ $p->id }}, 'Selesai')"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-xs shadow">
                                        ✅ Selesai
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">Belum ada pengaduan untuk bidang ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Tanggapan --}}
    @if ($isModalOpen)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 transform transition duration-300 scale-100">
                <h3 class="text-lg font-semibold mb-3 border-b pb-2 text-gray-800">Tanggapan Bidang</h3>
                <textarea wire:model="tanggapan" rows="4"
                    class="w-full border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-4"></textarea>
                <div class="flex justify-end space-x-2">
                    <button wire:click="closeModal"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">Tutup</button>
                    <button wire:click="simpanTanggapan"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Simpan</button>
                </div>
            </div>
        </div>
    @endif
</div>
