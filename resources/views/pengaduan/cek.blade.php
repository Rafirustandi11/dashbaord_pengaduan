<x-guest-layout>
<div class="min-h-screen flex items-center justify-center px-4 py-12
    bg-gradient-to-br from-blue-50 to-indigo-100
    dark:from-slate-900 dark:via-blue-950 dark:to-slate-900
    transition-colors duration-300">

    <div class="w-full max-w-lg space-y-5">

        {{-- Header --}}
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-slate-100">
                🔍 Cek Status Pengaduan
            </h1>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Masukkan kode pengaduan dan nomor HP yang Anda daftarkan
            </p>
        </div>

        {{-- Form Cek --}}
        <div class="rounded-2xl border shadow-sm p-6
            bg-white border-gray-100
            dark:bg-white/5 dark:border-white/10
            backdrop-blur-xl transition-colors duration-300">

            <form action="{{ route('pengaduan.cek.hasil') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Error not found --}}
                @if ($errors->has('not_found'))
                <div class="rounded-xl border px-4 py-3 text-sm flex items-center gap-2
                    bg-red-50 border-red-200 text-red-600
                    dark:bg-red-500/10 dark:border-red-500/25 dark:text-red-400">
                    <span>❌</span>
                    <span>{{ $errors->first('not_found') }}</span>
                </div>
                @endif

                {{-- Kode Pengaduan --}}
                <div>
                    <label class="block text-sm font-medium mb-1.5
                        text-gray-700 dark:text-slate-300">
                        Kode Pengaduan
                    </label>
                    <input
                        type="text"
                        name="kode_pengaduan"
                        value="{{ old('kode_pengaduan') }}"
                        placeholder="Contoh: ADU-202605-0001"
                        autocomplete="off"
                        class="w-full px-4 py-2.5 rounded-xl text-sm border font-mono uppercase
                            bg-gray-50 border-gray-200 text-gray-800 placeholder-gray-400
                            dark:bg-white/10 dark:border-white/15 dark:text-slate-200 dark:placeholder-slate-500
                            focus:outline-none focus:ring-2 focus:ring-indigo-400/50 transition
                            @error('kode_pengaduan') border-red-400 @enderror">
                    @error('kode_pengaduan')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No. HP --}}
                <div>
                    <label class="block text-sm font-medium mb-1.5
                        text-gray-700 dark:text-slate-300">
                        Nomor HP / WA
                    </label>
                    <input
                        type="text"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        placeholder="Contoh: 081234567890"
                        autocomplete="off"
                        class="w-full px-4 py-2.5 rounded-xl text-sm border
                            bg-gray-50 border-gray-200 text-gray-800 placeholder-gray-400
                            dark:bg-white/10 dark:border-white/15 dark:text-slate-200 dark:placeholder-slate-500
                            focus:outline-none focus:ring-2 focus:ring-indigo-400/50 transition
                            @error('no_hp') border-red-400 @enderror">
                    @error('no_hp')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-2.5 rounded-xl text-sm font-semibold text-white transition
                        bg-indigo-600 hover:bg-indigo-700
                        dark:bg-indigo-500 dark:hover:bg-indigo-600">
                    Cari Pengaduan
                </button>
            </form>
        </div>

        {{-- ══════════════════════════════════
             HASIL — tampil jika pengaduan ditemukan
        ══════════════════════════════════ --}}
        @isset($pengaduan)
        @php
            $statusConfig = [
                'Menunggu'             => ['bg-red-50 text-red-700 border-red-200 dark:bg-red-500/15 dark:text-red-300 dark:border-red-500/25',    '🔴'],
                'Diteruskan ke Bidang' => ['bg-yellow-50 text-yellow-700 border-yellow-200 dark:bg-yellow-500/15 dark:text-yellow-300 dark:border-yellow-500/25', '🟡'],
                'Proses'               => ['bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-500/15 dark:text-blue-300 dark:border-blue-500/25',   '🔵'],
                'Selesai'              => ['bg-green-50 text-green-700 border-green-200 dark:bg-green-500/15 dark:text-green-300 dark:border-green-500/25', '🟢'],
            ];
            [$sCls, $sEmoji] = $statusConfig[$pengaduan->status] ?? ['bg-gray-50 text-gray-600 border-gray-200 dark:bg-slate-500/15 dark:text-slate-300 dark:border-slate-500/25', '⚪'];
        @endphp

        <div class="rounded-2xl border shadow-sm overflow-hidden
            bg-white border-gray-100
            dark:bg-white/5 dark:border-white/10
            backdrop-blur-xl transition-colors duration-300">

            {{-- Header hasil --}}
            <div class="px-6 py-4 border-b flex items-center justify-between
                border-gray-100 dark:border-white/10
                bg-gray-50 dark:bg-white/[0.03]">
                <div>
                    <p class="text-xs text-gray-400 dark:text-slate-500 uppercase tracking-widest font-semibold">
                        Hasil Pencarian
                    </p>
                    <p class="font-mono font-bold text-indigo-600 dark:text-indigo-400 mt-0.5">
                        {{ $pengaduan->kode_pengaduan }}
                    </p>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold border {{ $sCls }}">
                    {{ $sEmoji }} {{ $pengaduan->status }}
                </span>
            </div>

            <div class="p-6 space-y-5">

                {{-- Info pelapor --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 dark:text-slate-500 mb-0.5">Nama Pelapor</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-slate-200">
                            {{ $pengaduan->nama_warga }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 dark:text-slate-500 mb-0.5">Tanggal Masuk</p>
                        <p class="text-sm text-gray-700 dark:text-slate-300">
                            {{ $pengaduan->created_at->translatedFormat('d M Y, H:i') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 dark:text-slate-500 mb-0.5">Kategori</p>
                        <p class="text-sm text-gray-700 dark:text-slate-300">
                            {{ $pengaduan->kategori ?? '—' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 dark:text-slate-500 mb-0.5">Bidang Tujuan</p>
                        <p class="text-sm text-gray-700 dark:text-slate-300 uppercase">
                            {{ $pengaduan->bidang_tujuan ?? '—' }}
                        </p>
                    </div>
                </div>

                {{-- Isi laporan --}}
                <div>
                    <p class="text-xs text-gray-400 dark:text-slate-500 mb-1">Isi Laporan</p>
                    <div class="rounded-xl border p-3 text-sm leading-relaxed
                        bg-gray-50 border-gray-200 text-gray-700
                        dark:bg-white/5 dark:border-white/10 dark:text-slate-300">
                        {{ $pengaduan->isi_laporan }}
                    </div>
                </div>

                {{-- Tanggapan / Balasan --}}
                @if ($pengaduan->balasan || $pengaduan->tanggapan_bidang)
                <div class="rounded-xl border p-4 space-y-3
                    bg-green-50 border-green-200
                    dark:bg-green-500/10 dark:border-green-500/20">
                    <p class="text-xs font-semibold uppercase tracking-widest
                        text-green-600 dark:text-green-400">
                        💬 Tanggapan
                    </p>

                    @if ($pengaduan->balasan)
                    <div>
                        <p class="text-xs text-green-500 dark:text-green-500 mb-0.5">Admin</p>
                        <p class="text-sm text-green-800 dark:text-green-300 leading-relaxed">
                            {{ $pengaduan->balasan }}
                        </p>
                    </div>
                    @endif

                    @if ($pengaduan->tanggapan_bidang)
                    <div class="border-t border-green-200 dark:border-green-500/20 pt-3">
                        <p class="text-xs text-green-500 dark:text-green-500 mb-0.5">
                            Bidang {{ strtoupper($pengaduan->bidang_tujuan ?? '') }}
                        </p>
                        <p class="text-sm text-green-800 dark:text-green-300 leading-relaxed">
                            {{ $pengaduan->tanggapan_bidang }}
                        </p>
                    </div>
                    @endif
                </div>
                @else
                <div class="rounded-xl border px-4 py-3 text-sm flex items-center gap-2
                    bg-amber-50 border-amber-200 text-amber-700
                    dark:bg-amber-500/10 dark:border-amber-500/20 dark:text-amber-300">
                    <span>⏳</span>
                    <span>Pengaduan Anda sedang diproses. Belum ada tanggapan saat ini.</span>
                </div>
                @endif

                {{-- Tanggal selesai --}}
                @if ($pengaduan->tanggal_selesai)
                <div class="flex items-center gap-2 text-xs
                    text-green-600 dark:text-green-400">
                    <span>✅</span>
                    <span>Diselesaikan pada
                        <strong>{{ \Carbon\Carbon::parse($pengaduan->tanggal_selesai)->translatedFormat('d M Y, H:i') }}</strong>
                    </span>
                </div>
                @endif

            </div>
        </div>
        @endisset

        {{-- Link balik --}}
        <div class="text-center">
            <a href="{{ route('pengaduan.create') }}"
                class="text-xs text-indigo-500 hover:underline dark:text-indigo-400">
                ← Kembali ke Form Pengaduan
            </a>
        </div>

    </div>
</div>
</x-guest-layout>