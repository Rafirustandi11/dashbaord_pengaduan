<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Bidang - {{ strtoupper(Auth::user()->bidang ?? 'EGOV') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto space-y-6">

     
            <div class="ml-auto flex gap-2">
                <button wire:click="exportCsv" class="px-3 py-2 bg-green-600 text-white rounded">Export CSV</button>
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div class="p-5 rounded-xl shadow bg-white">
                <div class="text-gray-700 text-sm">Total Pengaduan</div>
                <div class="mt-2 text-3xl font-bold">{{ $stats['total'] ?? 0 }}</div>
            </div>
            <div class="p-5 rounded-xl shadow bg-white">
                <div class="text-gray-700 text-sm">Menunggu</div>
                <div class="mt-2 text-3xl font-bold">{{ $stats['menunggu'] ?? 0 }}</div>
            </div>
            <div class="p-5 rounded-xl shadow bg-white">
                <div class="text-gray-700 text-sm">Proses</div>
                <div class="mt-2 text-3xl font-bold">{{ $stats['proses'] ?? 0 }}</div>
            </div>
            <div class="p-5 rounded-xl shadow bg-white">
                <div class="text-gray-700 text-sm">Selesai</div>
                <div class="mt-2 text-3xl font-bold text-green-600">{{ $stats['selesai'] ?? 0 }}</div>
            </div>
        </div>

        {{-- CHARTS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- LINE 6 BULAN --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-3">Grafik 6 Bulan</h3>
                <div class="h-64">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>

            {{-- 7 HARI --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-3">7 Hari Terakhir</h3>
                <div class="h-64">
                    <canvas id="chart7Hari"></canvas>
                </div>
            </div>

            {{-- BAR STATUS --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-3">Status</h3>
                <div class="h-64">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            {{-- JENIS --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-3">Jenis Pengaduan</h3>
                <div class="h-64">
                    <canvas id="jenisChart"></canvas>
                </div>
            </div>

            {{-- DONUT PERCENTAGE (ukuran kecil) --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-3">Distribusi (%)</h3>
                <div class="max-w-[260px] mx-auto h-64 flex items-center">
                    <canvas id="donutChart"></canvas>
                </div>
            </div>

        </div>

        {{-- TABLE LATEST (per bidang) --}}
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold mb-3">Pengaduan Terbaru (Bidang: {{ strtoupper($bidangFilter) }})</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600">
                            <th class="p-2">Nama</th>
                            <th class="p-2">Email</th>
                            <th class="p-2">Kategori</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestPengaduan as $p)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2">{{ $p->nama_warga }}</td>
                                <td class="p-2">{{ $p->email ?? '-' }}</td>
                                <td class="p-2">{{ $p->kategori }}</td>
                                <td class="p-2">{{ $p->status }}</td>
                                <td class="p-2">{{ $p->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-4 text-center text-gray-400">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- Inline Chart.js (Livewire v3 safe) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Livewire v3 safe chart rendering
        const charts = {};

        function destroyIfExists(key) {
            if (charts[key]) {
                try { charts[key].destroy(); } catch(e) {}
                charts[key] = null;
            }
        }

        function renderLineChart() {
            const el = document.getElementById('lineChart'); if (!el) return;
            destroyIfExists('lineChart');
            charts['lineChart'] = new Chart(el, {
                type: 'line',
                data: { labels: @json($chartLine['labels']), datasets: [{ label: 'Total Pengaduan', data: @json($chartLine['values']), borderColor: "{{ $selectedColors['primary'] }}", backgroundColor: "{{ $selectedColors['primary'] }}33", tension: 0.35 }] },
                options: { responsive: true }
            });
        }

        function render7Hari() {
            const el = document.getElementById('chart7Hari'); if (!el) return;
            destroyIfExists('chart7Hari');
            charts['chart7Hari'] = new Chart(el, {
                type: 'bar', data: { labels: @json($chart7Hari['labels']), datasets: [{ label: 'Per Hari', data: @json($chart7Hari['values']), backgroundColor: "{{ $selectedColors['accent'] }}" }] }, options: { responsive: true }
            });
        }

        function renderBarChart() {
            const el = document.getElementById('barChart'); if (!el) return;
            destroyIfExists('barChart');
            charts['barChart'] = new Chart(el, {
                type: 'bar', data: { labels: @json($chartBar['labels']), datasets: [{ data: @json($chartBar['values']), backgroundColor: ["{{ $selectedColors['warn'] }}","{{ $selectedColors['primary'] }}","{{ $selectedColors['accent'] }}"] }] }, options: { responsive: true }
            });
        }

        function renderJenisChart() {
            const el = document.getElementById('jenisChart'); if (!el) return;
            destroyIfExists('jenisChart');
            charts['jenisChart'] = new Chart(el, { type: 'doughnut', data: { labels: @json($chartJenis['labels']), datasets: [{ data: @json($chartJenis['values']), backgroundColor: ['#6366f1','#ec4899','#10b981','#f59e0b','#ef4444'] }] }, options: { responsive: true } });
        }

        function renderDonutChart() {
            const el = document.getElementById('donutChart'); if (!el) return;
            destroyIfExists('donutChart');
            charts['donutChart'] = new Chart(el, { type: 'doughnut', data: { labels: @json($chartDonut['labels']), datasets: [{ data: @json($chartDonut['values']), backgroundColor: ['#f87171','#fb923c','#34d399'] }] }, options: { responsive: true, cutout: '50%' } });
        }

        function renderAll() {
            renderLineChart(); render7Hari(); renderBarChart(); renderJenisChart(); renderDonutChart();
        }

        // Run on initial load and on Livewire updates
        document.addEventListener('DOMContentLoaded', renderAll);
        document.addEventListener('livewire:navigated', renderAll);
        // Livewire hook to render after element updates
        if (window.Livewire && Livewire.hook) {
            Livewire.hook('element.updated', (el, component) => {
                // only rerender charts when our component updated (optional):
                // if (component.fingerprint.name === 'bidang.dashboard-bidang') { renderAll(); }
                renderAll();
            });
        }

    </script>
</div>
