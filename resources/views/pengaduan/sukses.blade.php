{{-- resources/views/pengaduan/sukses.blade.php --}}

<x-guest-layout>

<div class="min-h-screen flex items-center justify-center px-4 py-12
    bg-gradient-to-br from-blue-50 to-indigo-100
    dark:from-slate-900 dark:via-blue-950 dark:to-slate-900
    transition-colors duration-300">

    <div class="w-full max-w-md">

        {{-- Card Utama --}}
        <div class="rounded-2xl border shadow-xl p-8 text-center
            bg-white border-gray-100
            dark:bg-white/5 dark:border-white/10
            backdrop-blur-xl transition-colors duration-300">

            {{-- Icon Sukses --}}
            <div class="flex justify-center mb-5">
                <div class="w-20 h-20 rounded-full flex items-center justify-center
                    bg-green-50 border-2 border-green-200
                    dark:bg-green-500/15 dark:border-green-500/30">
                    <svg class="w-10 h-10 text-green-500 dark:text-green-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

            {{-- Judul --}}
            <h1 class="text-xl font-bold mb-1
                text-gray-800 dark:text-slate-100">
                Pengaduan Berhasil Dikirim!
            </h1>
            <p class="text-sm text-gray-500 dark:text-slate-400 mb-6">
                Terima kasih. Pengaduan Anda sudah kami terima dan akan segera ditindaklanjuti.
            </p>

            {{-- Kode Pengaduan --}}
            @if (session('kode_pengaduan_baru'))
            <div class="rounded-xl border p-5 mb-6 text-left
                bg-indigo-50 border-indigo-200
                dark:bg-indigo-500/10 dark:border-indigo-500/25">

                <p class="text-xs font-semibold uppercase tracking-widest mb-2
                    text-indigo-500 dark:text-indigo-400">
                    ID Pengaduan Anda
                </p>

                <div class="flex items-center justify-between gap-3">
                    <span id="kode-text"
                        class="font-mono text-2xl font-bold tracking-wider
                            text-indigo-700 dark:text-indigo-300">
                        {{ session('kode_pengaduan_baru') }}
                    </span>

                    {{-- Tombol Copy --}}
                    <button onclick="copyKode()"
                        title="Salin kode"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium
                            border transition
                            bg-white border-indigo-200 text-indigo-600 hover:bg-indigo-50
                            dark:bg-white/10 dark:border-indigo-500/30 dark:text-indigo-300 dark:hover:bg-white/20">
                        <svg id="icon-copy" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2
                                   M16 8h2a2 2 0 012 2v8a2 2 0 01-2 2h-8a2 2 0 01-2-2v-2"/>
                        </svg>
                        <svg id="icon-check" class="w-3.5 h-3.5 hidden text-green-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span id="copy-label">Salin</span>
                    </button>
                </div>

                <p class="text-xs mt-3 text-indigo-500 dark:text-indigo-400 leading-relaxed">
                    ⚠️ <strong>Simpan kode ini.</strong> Gunakan untuk memantau
                    status pengaduan Anda.
                </p>
            </div>
            @else
            {{-- Fallback jika session sudah expired --}}
            <div class="rounded-xl border p-4 mb-6 text-sm
                bg-amber-50 border-amber-200 text-amber-700
                dark:bg-amber-500/10 dark:border-amber-500/25 dark:text-amber-300">
                Kode pengaduan tidak tersedia. Kemungkinan sesi sudah berakhir.
                Silakan hubungi petugas untuk konfirmasi.
            </div>
            @endif

            {{-- Info Proses --}}
            <div class="rounded-xl border p-4 mb-6 text-left space-y-3
                bg-gray-50 border-gray-200
                dark:bg-white/5 dark:border-white/10">
                <p class="text-xs font-semibold uppercase tracking-widest
                    text-gray-400 dark:text-slate-500">
                    Proses Selanjutnya
                </p>
                @foreach ([
                    ['icon' => '📥', 'teks' => 'Pengaduan diterima & dicatat oleh admin'],
                    ['icon' => '📋', 'teks' => 'Admin meneruskan ke bidang yang berwenang'],
                    ['icon' => '⚙️',  'teks' => 'Bidang menindaklanjuti pengaduan Anda'],
                    ['icon' => '✅', 'teks' => 'Anda akan mendapat konfirmasi penyelesaian'],
                ] as $step)
                <div class="flex items-start gap-3">
                    <span class="text-base shrink-0 mt-0.5">{{ $step['icon'] }}</span>
                    <p class="text-xs text-gray-600 dark:text-slate-400 leading-relaxed">
                        {{ $step['teks'] }}
                    </p>
                </div>
                @endforeach
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('pengaduan.create') }}"
                    class="flex-1 py-2.5 px-4 rounded-xl text-sm font-medium text-center
                        border transition
                        border-gray-200 text-gray-600 hover:bg-gray-50
                        dark:border-white/15 dark:text-slate-300 dark:hover:bg-white/10">
                    ＋ Buat Pengaduan Baru
                </a>
                <a href="{{ route('pengaduan.cek') }}"
                    class="flex-1 py-2.5 px-4 rounded-xl text-sm font-medium text-center
                        transition text-white
                        bg-indigo-600 hover:bg-indigo-700
                        dark:bg-indigo-500 dark:hover:bg-indigo-600">
                    Tracking Pengaduan
                </a>
            </div>

        </div>

        {{-- Footer kecil --}}
        <p class="text-center text-xs mt-5 text-gray-400 dark:text-slate-600">
            Dinas Komunikasi dan Informatika &mdash; Sistem Pengaduan Masyarakat
        </p>

    </div>
</div>

{{-- Script copy to clipboard --}}
<script>
function copyKode() {
    const kode = document.getElementById('kode-text').innerText.trim();
    navigator.clipboard.writeText(kode).then(() => {
        document.getElementById('icon-copy').classList.add('hidden');
        document.getElementById('icon-check').classList.remove('hidden');
        document.getElementById('copy-label').textContent = 'Tersalin!';

        setTimeout(() => {
            document.getElementById('icon-copy').classList.remove('hidden');
            document.getElementById('icon-check').classList.add('hidden');
            document.getElementById('copy-label').textContent = 'Salin';
        }, 2000);
    });
}
</script>

</x-guest-layout>