{{-- resources/views/livewire/admin/histori-pengaduan.blade.php --}}

<div class="py-8 min-h-screen
    bg-gradient-to-br from-blue-50 to-indigo-100
    dark:from-slate-900 dark:via-blue-950 dark:to-slate-900
    transition-colors duration-300">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            📋 Histori Pengaduan
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- ════════════════════════════════════════════
             KARTU STATISTIK
        ════════════════════════════════════════════ --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @php
                $cards = [
                    [
                        'label'   => 'Total Pengaduan',
                        'value'   => $totalPengaduan,
                        'icon'    => '📋',
                        'light'   => 'bg-white border-blue-100 text-blue-700',
                        'dark'    => 'dark:bg-blue-500/10 dark:border-blue-500/20 dark:text-blue-300',
                        'numcls'  => 'text-blue-700 dark:text-blue-300',
                    ],
                    [
                        'label'   => 'Selesai',
                        'value'   => $totalSelesai,
                        'icon'    => '✅',
                        'light'   => 'bg-white border-green-100 text-green-700',
                        'dark'    => 'dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-300',
                        'numcls'  => 'text-green-700 dark:text-green-300',
                    ],
                    [
                        'label'   => 'Diproses',
                        'value'   => $totalDiproses,
                        'icon'    => '⚙️',
                        'light'   => 'bg-white border-yellow-100 text-yellow-700',
                        'dark'    => 'dark:bg-yellow-500/10 dark:border-yellow-500/20 dark:text-yellow-300',
                        'numcls'  => 'text-yellow-600 dark:text-yellow-300',
                    ],
                    [
                        'label'   => 'Baru Masuk',
                        'value'   => $totalBaru,
                        'icon'    => '🔔',
                        'light'   => 'bg-white border-red-100 text-red-700',
                        'dark'    => 'dark:bg-red-500/10 dark:border-red-500/20 dark:text-red-300',
                        'numcls'  => 'text-red-600 dark:text-red-300',
                    ],
                ];
            @endphp

            @foreach ($cards as $c)
            <div class="rounded-2xl border p-5 shadow-sm
                {{ $c['light'] }} {{ $c['dark'] }}
                backdrop-blur-xl transition-colors duration-300">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xl">{{ $c['icon'] }}</span>
                    <span class="text-xs font-medium opacity-70">{{ $c['label'] }}</span>
                </div>
                <p class="text-3xl font-bold {{ $c['numcls'] }}">{{ $c['value'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- ════════════════════════════════════════════
             FILTER & SEARCH
        ════════════════════════════════════════════ --}}
        <div class="rounded-2xl border p-5 shadow-sm
            bg-white border-gray-200
            dark:bg-white/5 dark:border-white/10
            backdrop-blur-xl transition-colors duration-300">

            <p class="text-xs font-semibold uppercase tracking-widest mb-3
                text-gray-500 dark:text-slate-400">
                Filter & Pencarian
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

                {{-- Search --}}
                <div>
                    <label class="block text-xs font-medium mb-1
                        text-gray-600 dark:text-slate-400">
                        Cari ID / Nama / No. HP
                    </label>
                    <input
                        type="text"
                        wire:model.live.debounce.400ms="search"
                        placeholder="ADU-202505-... atau nama..."
                        class="w-full px-3 py-2 rounded-xl text-sm border
                            bg-gray-50 border-gray-200 text-gray-800 placeholder-gray-400
                            dark:bg-white/10 dark:border-white/15 dark:text-slate-200 dark:placeholder-slate-500
                            focus:outline-none focus:ring-2 focus:ring-blue-400/50 transition">
                </div>

                {{-- Filter Bidang --}}
                <div>
                    <label class="block text-xs font-medium mb-1
                        text-gray-600 dark:text-slate-400">
                        Bidang
                    </label>
                    <select
                        wire:model.live="filterBidang"
                        class="w-full px-3 py-2 rounded-xl text-sm border
                            bg-gray-50 border-gray-200 text-gray-800
                            dark:bg-white/10 dark:border-white/15 dark:text-slate-200
                            focus:outline-none focus:ring-2 focus:ring-blue-400/50 transition">
                        <option value="">Semua Bidang</option>
                        <option value="egov">E-Government</option>
                        <option value="itik">ITIK</option>
                        <option value="statistik">Statistik</option>
                        <option value="persandian">Persandian</option>
                        <option value="pikp">PIKP</option>
                    </select>
                </div>

                {{-- Filter Kategori (dinamis sesuai bidang dipilih) --}}
                <div>
                    <label class="block text-xs font-medium mb-1
                        text-gray-600 dark:text-slate-400">
                        Kategori Masalah
                        @if ($filterBidang)
                            <span class="ml-1 text-blue-500 dark:text-blue-400 normal-case font-normal">
                                ({{ ucfirst($filterBidang) }})
                            </span>
                        @endif
                    </label>
                    <select
                        wire:model.live="filterKategori"
                        class="w-full px-3 py-2 rounded-xl text-sm border
                            bg-gray-50 border-gray-200 text-gray-800
                            dark:bg-white/10 dark:border-white/15 dark:text-slate-200
                            focus:outline-none focus:ring-2 focus:ring-blue-400/50 transition">
                        <option value="">Semua Kategori</option>
                        @foreach ($opsiKategori as $opsi)
                            <option value="{{ $opsi }}">{{ $opsi }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Status --}}
                <div>
                    <label class="block text-xs font-medium mb-1
                        text-gray-600 dark:text-slate-400">
                        Status
                    </label>
                    <select
                        wire:model.live="filterStatus"
                        class="w-full px-3 py-2 rounded-xl text-sm border
                            bg-gray-50 border-gray-200 text-gray-800
                            dark:bg-white/10 dark:border-white/15 dark:text-slate-200
                            focus:outline-none focus:ring-2 focus:ring-blue-400/50 transition">
                        <option value="">Semua Status</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Diteruskan ke Bidang">Diteruskan ke Bidang</option>
                        <option value="Proses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

            </div>
        </div>

        {{-- ════════════════════════════════════════════
             TABEL PENGADUAN
        ════════════════════════════════════════════ --}}
        <div class="rounded-2xl border shadow-sm overflow-hidden
            bg-white border-gray-200
            dark:bg-white/5 dark:border-white/10
            backdrop-blur-xl transition-colors duration-300">

            {{-- Panel header --}}
            <div class="flex items-center justify-between px-6 py-4
                border-b border-gray-100 dark:border-white/10">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-slate-200">
                    📄 Daftar Semua Pengaduan
                    <span class="font-normal text-gray-400 dark:text-slate-500 text-xs ml-1">
                        ({{ $pengaduans->total() }} data)
                    </span>
                </h3>
                <div wire:loading
                    class="flex items-center gap-1.5 text-xs text-blue-500 dark:text-blue-400">
                    <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v8H4z"/>
                    </svg>
                    Memuat...
                </div>
            </div>

            {{-- Scroll horizontal --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead>
                        <tr class="text-xs font-semibold uppercase tracking-wider
                            border-b border-gray-100 dark:border-white/10
                            text-gray-500 dark:text-slate-500
                            bg-gray-50 dark:bg-white/[0.03]">
                            <th class="px-4 py-3 text-left w-8">#</th>
                            <th class="px-4 py-3 text-left">ID Pengaduan</th>
                            <th class="px-4 py-3 text-left">Nama Warga</th>
                            <th class="px-4 py-3 text-left">No. HP</th>
                            <th class="px-4 py-3 text-left">Kategori Masalah</th>
                            <th class="px-4 py-3 text-left" style="min-width:190px">Deskripsi Singkat</th>
                            <th class="px-4 py-3 text-left">Bidang</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Tanggal Masuk</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">

                        @forelse ($pengaduans as $i => $p)
                        @php
                            // ── Badge bidang ───────────────────────────────────
                            $bidangMap = [
                                'egov'       => ['label'=>'E-Gov',      'lc'=>'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-500/20 dark:text-blue-300 dark:border-blue-500/30'],
                                'itik'       => ['label'=>'ITIK',       'lc'=>'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-500/20 dark:text-emerald-300 dark:border-emerald-500/30'],
                                'statistik'  => ['label'=>'Statistik',  'lc'=>'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-500/20 dark:text-amber-300 dark:border-amber-500/30'],
                                'persandian' => ['label'=>'Persandian', 'lc'=>'bg-violet-50 text-violet-700 border-violet-200 dark:bg-violet-500/20 dark:text-violet-300 dark:border-violet-500/30'],
                                'pikp'       => ['label'=>'PIKP',       'lc'=>'bg-pink-50 text-pink-700 border-pink-200 dark:bg-pink-500/20 dark:text-pink-300 dark:border-pink-500/30'],
                            ];
                            $bKey  = strtolower(trim($p->bidang_tujuan ?? ''));
                            $bInfo = $bidangMap[$bKey] ?? ['label'=>strtoupper($bKey ?: '-'),'lc'=>'bg-gray-50 text-gray-600 border-gray-200 dark:bg-slate-500/20 dark:text-slate-300 dark:border-slate-500/30'];

                            // ── Badge status ────────────────────────────────────
                            $statusMap = [
                                'Selesai'              => 'bg-green-50 text-green-700 border-green-200 dark:bg-green-500/20 dark:text-green-300 dark:border-green-500/30',
                                'Proses'               => 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-500/20 dark:text-blue-300 dark:border-blue-500/30',
                                'Diteruskan ke Bidang' => 'bg-yellow-50 text-yellow-700 border-yellow-200 dark:bg-yellow-500/20 dark:text-yellow-300 dark:border-yellow-500/30',
                                'Menunggu'             => 'bg-red-50 text-red-700 border-red-200 dark:bg-red-500/20 dark:text-red-300 dark:border-red-500/30',
                            ];
                            $sClass = $statusMap[$p->status] ?? 'bg-gray-50 text-gray-600 border-gray-200 dark:bg-slate-500/20 dark:text-slate-300 dark:border-slate-500/30';

                            // ── Deskripsi (dari isi_laporan) ────────────────────
                            $deskFull   = $p->isi_laporan ?? '';
                            $deskPendek = \Illuminate\Support\Str::limit($deskFull, 75, '...');
                        @endphp

                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors duration-150">

                            {{-- No urut --}}
                            <td class="px-4 py-3 text-xs text-gray-400 dark:text-slate-600">
                                {{ $pengaduans->firstItem() + $i }}
                            </td>

                            {{-- ID Pengaduan --}}
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if ($p->kode_pengaduan)
                                    <span class="inline-block font-mono text-xs font-semibold
                                        px-2.5 py-1 rounded-lg border
                                        bg-indigo-50 text-indigo-700 border-indigo-200
                                        dark:bg-indigo-500/15 dark:text-indigo-300 dark:border-indigo-500/25">
                                        {{ $p->kode_pengaduan }}
                                    </span>
                                @else
                                    <span class="text-gray-300 dark:text-slate-600 text-xs">—</span>
                                @endif
                            </td>

                            {{-- Nama Warga --}}
                            <td class="px-4 py-3">
                                <p class="font-medium text-gray-800 dark:text-slate-200 whitespace-nowrap">
                                    {{ $p->nama_warga }}
                                </p>
                                @if ($p->email)
                                    <p class="text-xs text-gray-400 dark:text-slate-500 mt-0.5">
                                        {{ $p->email }}
                                    </p>
                                @endif
                            </td>

                            {{-- No. HP --}}
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if (!empty($p->no_hp))
                                    <a href="https://wa.me/62{{ ltrim($p->no_hp, '0') }}"
                                       target="_blank"
                                       title="Hubungi via WhatsApp"
                                       class="inline-flex items-center gap-1.5 text-xs
                                           text-green-600 hover:text-green-500
                                           dark:text-green-400 dark:hover:text-green-300
                                           transition">
                                        {{-- WhatsApp icon --}}
                                        <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.17 1.6 5.98L0 24l6.18-1.62A11.93 11.93 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.21-1.25-6.23-3.48-8.52zM12 22c-1.84 0-3.64-.5-5.2-1.44l-.37-.22-3.67.96.98-3.57-.24-.37A9.93 9.93 0 0 1 2 12C2 6.48 6.48 2 12 2s10 4.48 10 10-4.48 10-10 10zm5.47-7.4c-.3-.15-1.77-.87-2.05-.97-.27-.1-.47-.15-.67.15s-.77.97-.94 1.17-.35.22-.65.07c-.3-.15-1.27-.47-2.42-1.49-.9-.8-1.5-1.78-1.68-2.08-.17-.3-.02-.46.13-.6.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.09 4.49.71.31 1.27.49 1.7.63.71.22 1.36.19 1.87.12.57-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.19-.57-.34z"/>
                                        </svg>
                                        {{ $p->no_hp }}
                                    </a>
                                @else
                                    <span class="text-gray-300 dark:text-slate-600 text-xs">—</span>
                                @endif
                            </td>

                            {{-- Kategori --}}
                            <td class="px-4 py-3">
                                @if ($p->kategori)
                                    <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-medium border
                                        bg-sky-50 text-sky-700 border-sky-200
                                        dark:bg-sky-500/15 dark:text-sky-300 dark:border-sky-500/25">
                                        {{ $p->kategori }}
                                    </span>
                                @else
                                    <span class="text-gray-300 dark:text-slate-600 text-xs">—</span>
                                @endif
                            </td>

                            {{-- Deskripsi Singkat --}}
                            <td class="px-4 py-3" style="max-width:200px">
                                @if ($deskFull)
                                    <span class="text-xs leading-relaxed block
                                        text-gray-500 dark:text-slate-400"
                                        title="{{ $deskFull }}">
                                        {{ $deskPendek }}
                                    </span>
                                @else
                                    <span class="text-gray-300 dark:text-slate-600 text-xs">—</span>
                                @endif
                            </td>

                            {{-- Bidang --}}
                            <td class="px-4 py-3">
                                <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-medium border
                                    {{ $bInfo['lc'] }}">
                                    {{ $bInfo['label'] }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-medium border
                                    {{ $sClass }}">
                                    {{ $p->status }}
                                </span>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-xs text-gray-700 dark:text-slate-300">
                                    {{ $p->created_at->translatedFormat('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-400 dark:text-slate-600 mt-0.5">
                                    {{ $p->created_at->format('H:i') }}
                                </p>
                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="9" class="px-5 py-14 text-center">
                                <div class="flex flex-col items-center gap-2
                                    text-gray-400 dark:text-slate-500">
                                    <svg class="w-10 h-10 opacity-30" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M9 17v-2a4 4 0 014-4 4 4 0 014 4v2M9 7a3 3 0 106 0 3 3 0 00-6 0M3 20h18"/>
                                    </svg>
                                    <p class="text-sm">Tidak ada pengaduan ditemukan.</p>
                                    @if ($search || $filterKategori || $filterBidang || $filterStatus)
                                        <button wire:click="$set('search','');$set('filterKategori','');$set('filterBidang','');$set('filterStatus','')"
                                            class="text-xs text-blue-500 hover:underline mt-1">
                                            Reset semua filter
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($pengaduans->hasPages())
            <div class="px-6 py-4 border-t flex items-center justify-between flex-wrap gap-3
                border-gray-100 dark:border-white/10">
                <p class="text-xs text-gray-400 dark:text-slate-500">
                    Data <span class="font-medium text-gray-700 dark:text-slate-300">
                        {{ $pengaduans->firstItem() }}–{{ $pengaduans->lastItem() }}
                    </span>
                    dari <span class="font-medium text-gray-700 dark:text-slate-300">
                        {{ $pengaduans->total() }}
                    </span>
                </p>
                {{ $pengaduans->links() }}
            </div>
            @else
            <div class="px-6 py-3 border-t border-gray-100 dark:border-white/10">
                <p class="text-xs text-gray-400 dark:text-slate-500">
                    Total <span class="font-medium text-gray-700 dark:text-slate-300">
                        {{ $pengaduans->count() }}
                    </span> data
                </p>
            </div>
            @endif

        </div>

        {{-- ════════════════════════════════════════════
             INFO NO. HP KOSONG (untuk data lama)
        ════════════════════════════════════════════ --}}
        @php $adaYangKosong = $pengaduans->whereNull('no_hp')->count(); @endphp
        @if ($adaYangKosong > 0)
        <div class="rounded-xl border px-4 py-3 text-xs flex items-start gap-2
            bg-amber-50 border-amber-200 text-amber-700
            dark:bg-amber-500/10 dark:border-amber-500/20 dark:text-amber-300">
            <span class="text-base shrink-0">⚠️</span>
            <span>
                <strong>{{ $adaYangKosong }} pengaduan</strong> tidak memiliki No. HP —
                data lama yang masuk sebelum kolom <code class="font-mono">no_hp</code> ditambahkan.
                Pengaduan baru akan otomatis tersimpan nomor HP-nya.
            </span>
        </div>
        @endif

    </div>
</div>  