<div class="p-6 bg-gray-50 min-h-screen">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Detail Pengaduan Bidang {{ ucfirst(Auth::user()->bidang) }}</h1>

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <p><strong>Nama Warga:</strong> {{ $pengaduan->nama_warga }}</p>
        <p><strong>Email:</strong> {{ $pengaduan->email ?? '-' }}</p>
        <p><strong>Kategori:</strong> {{ ucfirst($pengaduan->kategori) }}</p>
        <p><strong>Status:</strong>
            <span class="px-2 py-1 text-xs rounded
                {{ $pengaduan->status == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' :
                   ($pengaduan->status == 'Proses' ? 'bg-blue-100 text-blue-700' :
                   'bg-green-100 text-green-700') }}">
                {{ $pengaduan->status }}
            </span>
        </p>
        <p class="mt-4"><strong>Isi Laporan:</strong></p>
        <p class="bg-gray-50 border p-3 rounded">{{ $pengaduan->isi_laporan }}</p>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-2">Tanggapan Bidang (Opsional)</h2>

        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md text-green-700">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="simpanTanggapan">
            <textarea wire:model.defer="tanggapan_bidang" rows="5"
                class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Isi tanggapan bidang (opsional)..."></textarea>

            <div class="mt-4 flex justify-between">
                <a href="{{ route('bidang.dashboard') }}"
                    class="text-gray-600 hover:underline">← Kembali ke Dashboard</a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
