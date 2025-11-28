<div class="py-10 min-h-screen 
    bg-gradient-to-br from-blue-100/40 to-purple-100/40 
    dark:from-gray-900 dark:to-gray-800">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🧊 Histori Pengaduan (Glass Dashboard)
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- CARD STATISTIK --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">

            <div class="backdrop-blur-xl bg-white/30 dark:bg-gray-800/30 
                border border-white/40 dark:border-gray-600/40
                shadow-lg rounded-2xl p-5">
                <p class="text-xs text-gray-600 dark:text-gray-300">Total Pengaduan</p>
                <p class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalPengaduan }}</p>
            </div>

            <div class="backdrop-blur-xl bg-white/30 dark:bg-gray-800/30 
                border border-white/40 dark:border-gray-600/40
                shadow-lg rounded-2xl p-5">
                <p class="text-xs text-gray-600 dark:text-gray-300">Selesai</p>
                <p class="text-3xl font-semibold text-green-700 dark:text-green-400">{{ $totalSelesai }}</p>
            </div>

            <div class="backdrop-blur-xl bg-white/30 dark:bg-gray-800/30 
                border border-white/40 dark:border-gray-600/40
                shadow-lg rounded-2xl p-5">
                <p class="text-xs text-gray-600 dark:text-gray-300">Diproses</p>
                <p class="text-3xl font-semibold text-blue-700 dark:text-blue-400">{{ $totalDiproses }}</p>
            </div>

            <div class="backdrop-blur-xl bg-white/30 dark:bg-gray-800/30 
                border border-white/40 dark:border-gray-600/40
                shadow-lg rounded-2xl p-5">
                <p class="text-xs text-gray-600 dark:text-gray-300">Baru Masuk</p>
                <p class="text-3xl font-semibold text-yellow-600 dark:text-yellow-400">{{ $totalBaru }}</p>
            </div>

        </div>

        {{-- TABLE --}}
        <div class="backdrop-blur-xl 
            bg-white/30 dark:bg-gray-800/30
            border border-white/40 dark:border-gray-600/40 
            shadow-lg rounded-2xl p-6">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                📄 Daftar Semua Pengaduan (Dari Semua Bidang)
            </h3>

            <table class="w-full text-sm">

                {{-- HEADER --}}
                <thead class="bg-white/40 dark:bg-gray-700/40 
                    backdrop-blur-md border-b border-white/50 dark:border-gray-600/50">

                    <tr class="text-left text-xs font-semibold 
                        text-gray-700 dark:text-gray-300">

                        <th class="py-3 px-4">Nama Warga</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4">Bidang</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Tanggal Masuk</th>
                    </tr>

                </thead>

                {{-- BODY --}}
                <tbody class="backdrop-blur-md">

                    @forelse ($pengaduans as $p)
                        <tr class="hover:bg-white/40 dark:hover:bg-gray-700/40 transition">

                            <td class="py-2 px-4 text-gray-800 dark:text-gray-200">
                                {{ $p->nama_warga }}
                            </td>

                            <td class="py-2 px-4 text-gray-800 dark:text-gray-200">
                                {{ $p->kategori }}
                            </td>

                            <td class="py-2 px-4 text-gray-800 dark:text-gray-200">
                                {{ $p->bidang_tujuan }}
                            </td>

                            <td class="py-2 px-4">

                                <span class="
                                    px-3 py-1 rounded-full text-xs font-medium backdrop-blur-xl 
                                    border border-white/40 dark:border-gray-600/40

                                    @if($p->status == 'Selesai') text-green-900
                                    @elseif($p->status == 'Proses')
                                    @else
                                        bg-yellow-200/60 dark:bg-yellow-800/50 dark:text-yellow-200
                                    @endif
                                ">
                                    {{ $p->status }}
                                </span>

                            </td>

                            <td class="py-2 px-4 text-gray-600 dark:text-gray-400">
                                {{ $p->created_at->format('d M Y') }}
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" 
                                class="py-5 text-center 
                                text-gray-600 dark:text-gray-300">
                                Tidak ada data pengaduan.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>
