<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white flex flex-col">
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-r from-blue-700 via-blue-600 to-cyan-500 text-white py-20">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-10 container mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2 tracking-wide">
                Formulir Pengaduan Warga DKIS Kota Cirebon
            </h1>
            <p class="text-blue-100 text-base md:text-lg max-w-2xl mx-auto">
                Laporkan kendala, saran, atau masukan Anda terkait layanan digital, data, dan teknologi informasi
                Pemerintah Kota Cirebon.
            </p>
        </div>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-10 text-gray-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M985.66 92.83C906.67 72 823.78 52.12 743.84 37.45c-82.26-15-168.06-27.52-250.8-14.85C364.16 37.15 280.43 79.23 197.35 97.75c-69.93 15.34-136.76 13.89-197.35-1.4V120h1200V97.35c-58.6 14.57-122.77 17.76-214.34-4.52z"
                    fill="currentColor"></path>
            </svg>
        </div>
    </section>

    {{-- Form Section --}}
    <section class="flex-grow flex items-center justify-center py-16 px-4">
        @include('pengaduan.form', ['formFields' => $formFields])


    </section>

    {{-- Footer --}}
    <footer class="py-4 bg-gray-100 text-center text-gray-500 text-xs">
        © {{ date('Y') }} Dinas Komunikasi dan Informatika Kota Cirebon — Semua Hak Dilindungi
    </footer>

    {{-- Toast Notification --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="fixed top-6 right-6 bg-white border border-green-200 shadow-lg rounded-xl p-4 flex items-center gap-3 text-green-700 z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <path d="M5 13l4 4L19 7" />
            </svg>
            <div>
                <p class="font-semibold">Laporan berhasil dikirim!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="ml-3 text-gray-400 hover:text-gray-600">✕</button>
        </div>
    @endif
</div>
