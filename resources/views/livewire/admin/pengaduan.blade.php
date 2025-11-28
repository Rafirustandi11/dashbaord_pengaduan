<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Manajemen Pengaduan Warga
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Notifikasi --}}
        @if (session()->has('message'))
            <div class="bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-700
                text-green-700 dark:text-green-100 px-4 py-3 rounded">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 dark:bg-red-800 border border-red-400 dark:border-red-700
                text-red-700 dark:text-red-100 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif


        {{-- Filter + Search --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">

            <div class="grid md:grid-cols-3 gap-4 mb-4">
                <input wire:model.live="search" type="text" placeholder="Cari nama warga..."
                    class="col-span-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 
                    dark:text-gray-100 rounded-md shadow-sm w-full" />

                <select wire:model.live="filterStatus"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 
                    rounded-md shadow-sm w-full">
                    <option value="semua">Semua Status</option>
                    <option value="Menunggu">Menunggu</option>
                    <option value="Diteruskan ke Bidang">Diteruskan ke Bidang</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            {{-- Tabel --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">

                <table class="w-full text-sm text-gray-700 dark:text-gray-200">
                    <thead class="bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-blue-800 dark:to-cyan-700 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Nama Warga</th>
                            <th class="px-4 py-3 text-left">Kategori</th>
                            <th class="px-4 py-3 text-left">Bidang</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                        @forelse($pengaduans as $p)
                            <tr class="hover:bg-blue-50 dark:hover:bg-gray-700 transition-all">

                                <td class="px-4 py-3 font-semibold">{{ $p->nama_warga }}</td>
                                <td class="px-4 py-3">{{ $p->kategori }}</td>
                                <td class="px-4 py-3 capitalize">{{ $p->bidang_tujuan ?? '-' }}</td>

                                <td class="px-4 py-3">
                                    <x-status-badge :status="$p->status" />
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center items-center gap-3">

                                        {{-- Lihat Laporan Pengaduan Lengkap --}}
                                        <button wire:click="lihatLaporan({{ $p->id }})"
                                            class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 text-lg"
                                            title="Lihat Laporan">
                                            📄
                                        </button>

                                        {{-- Lihat Detail --}}
                                        <button wire:click="openModal('show', {{ $p->id }})"
                                            class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-lg"
                                            title="Detail">
                                            👁️
                                        </button>

                                        {{-- Edit --}}
                                        <button wire:click="openModal('edit', {{ $p->id }})"
                                            class="text-yellow-500 dark:text-yellow-400 hover:text-yellow-700 dark:hover:text-yellow-300 text-lg"
                                            title="Edit">
                                            ✏️
                                        </button>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 italic">
                                    Tidak ada data pengaduan.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>

        </div>


        {{-- MODAL DETAIL / EDIT --}}
        @if ($isModalOpen)
            <div class="fixed inset-0 bg-black/30 dark:bg-black/60 backdrop-blur-sm flex items-center justify-center z-40 px-4">

                <div class="bg-white dark:bg-gray-800 dark:text-gray-100 rounded-xl shadow-xl 
                    w-full max-w-md p-5 animate-fade-in">

                    <h3 class="text-lg font-semibold mb-3">
                        {{ $mode === 'show' ? 'Detail Pengaduan' : 'Edit Pengaduan' }}
                    </h3>

                    <div class="space-y-2 text-sm">
                        <p><strong>Nama:</strong> {{ $nama_warga }}</p>
                        <p><strong>Email:</strong> {{ $email }}</p>

                        <div>
                            <strong>Isi Laporan:</strong>
                            <p class="mt-1 p-2 bg-gray-100 dark:bg-gray-700 rounded-md 
                                max-h-24 overflow-y-auto text-xs">
                                {{ $isi_laporan }}
                            </p>
                        </div>

                        {{-- BIDANG TUJUAN --}}
                        @if ($mode === 'edit')
                            <div>
                                <label class="block text-xs font-medium">Bidang Tujuan</label>
                                <select wire:model="bidang_tujuan"
                                    class="w-full border-gray-300 dark:border-gray-700 
                                    dark:bg-gray-900 dark:text-gray-100 rounded-md text-sm">
                                    <option value="">-- pilih --</option>
                                    @foreach ($bidangs as $b)
                                        <option value="{{ $b }}">{{ $b }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        {{-- STATUS --}}
                        <div>
                            <label class="block text-xs font-medium">Status</label>
                            <select wire:model="status"
                                class="w-full border-gray-300 dark:border-gray-700 
                                dark:bg-gray-900 dark:text-gray-100 rounded-md text-sm">
                                <option value="Menunggu">Menunggu</option>
                                <option value="Diteruskan ke Bidang">Diteruskan ke Bidang</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        {{-- BALASAN ADMIN --}}
                        @if ($mode === 'edit')
                            <div>
                                <label class="block text-xs font-medium">Balasan Admin</label>
                                <textarea wire:model="balasan"
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 
                                    dark:text-gray-100 rounded-md text-sm max-h-20"></textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-medium">Tanggapan Bidang</label>
                                <textarea wire:model="tanggapan_bidang"
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 
                                    dark:text-gray-100 rounded-md text-sm max-h-20"></textarea>
                            </div>
                        @endif
                    </div>


                    <div class="flex justify-end space-x-2 mt-5 text-sm">
                        <button wire:click="closeModal"
                            class="px-3 py-1.5 bg-gray-200 dark:bg-gray-700 dark:text-gray-200 
                                rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                            Tutup
                        </button>

                        @if ($mode === 'edit')
                            <button wire:click="update"
                                class="px-3 py-1.5 bg-indigo-600 dark:bg-indigo-700 text-white rounded-md 
                                    hover:bg-indigo-700 dark:hover:bg-indigo-600">
                                Simpan
                            </button>
                        @endif
                    </div>

                </div>

            </div>
        @endif


        {{-- MODAL LAPORAN PENGADUAN (FULL DETAIL) --}}
        @if ($selectedPengaduan)
            <div class="fixed inset-0 bg-black/40 dark:bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 px-4">

                <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 
                    rounded-xl shadow-xl w-full max-w-xl p-6 animate-fade-in">

                    <h3 class="text-xl font-bold mb-3">Laporan Pengaduan Warga</h3>

                    <div class="space-y-2 text-sm">
                        <p><strong>Nama:</strong> {{ $selectedPengaduan->nama_warga }}</p>
                        <p><strong>Email:</strong> {{ $selectedPengaduan->email }}</p>
                        <p><strong>Kategori:</strong> {{ $selectedPengaduan->kategori }}</p>
                        <p><strong>Status:</strong> {{ $selectedPengaduan->status }}</p>
                        <p><strong>Bidang Tujuan:</strong> {{ $selectedPengaduan->bidang_tujuan ?? '-' }}</p>

                        {{-- ISI LAPORAN LENGKAP --}}
                        <div>
                            <strong>Isi Laporan:</strong>
                            <p class="mt-1 p-2 bg-gray-100 dark:bg-gray-700 rounded-md max-h-32 overflow-y-auto">
                                {{ $selectedPengaduan->isi_laporan }}
                            </p>
                        </div>

                        {{-- FOTO LAMPIRAN --}}
                        @if ($selectedPengaduan->lampiran)
                            <div class="mt-3">
                                <strong>Foto Bukti:</strong>
                                <img src="{{ asset('storage/' . $selectedPengaduan->lampiran) }}" 
                                     class="mt-2 rounded-lg shadow border border-gray-300 dark:border-gray-600 max-h-64">
                            </div>
                        @endif

                    </div>

                    <div class="flex justify-end mt-6">
                        <button wire:click="closeLaporan"
                            class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                            Tutup
                        </button>
                    </div>

                </div>

            </div>
        @endif

    </div>
</div>
