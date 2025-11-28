<div>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-700 dark:text-gray-200">Dashboard Admin</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto space-y-6">

        {{-- ===============================
            PROFIL ADMIN
        =============================== --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-6 border border-gray-200 dark:border-gray-700 flex items-center gap-6">

            {{-- FOTO PROFIL --}}
            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-blue-500 shadow">
                @if (Auth::user()->profile_photo_path)
                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" class="w-full h-full object-cover">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                         class="w-full h-full object-cover">
                @endif
            </div>

            {{-- INFORMASI ADMIN --}}
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                    {{ Auth::user()->name }}
                </h2>

                <p class="text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</p>

                <p class="text-sm text-blue-600 dark:text-blue-400 mt-1">
                    Peran: {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                </p>

                <a href="{{ route('admin.profil-admin') }}"
                   class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Kelola Profil
                </a>
            </div>

        </div>



        {{-- ===============================
             STATISTIK
        =============================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">

            <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-300 text-sm">Total Pengaduan</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $stats['total'] }}</h3>
            </div>

            <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-300 text-sm">Menunggu</p>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $stats['menunggu'] }}</h3>
            </div>

            <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-300 text-sm">Proses</p>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $stats['proses'] }}</h3>
            </div>

            <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-300 text-sm">Selesai</p>
                <h3 class="text-xl font-semibold text-green-600 dark:text-green-400">{{ $stats['selesai'] }}</h3>
            </div>

        </div>



        {{-- ===========================
            EXPORT DATA
        =========================== --}}
        <div class="flex gap-3 mt-5 mb-3">
            <a href="{{ route('admin.dashboard.export.excel') }}"
               class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                📥 Export Excel
            </a>

            <a href="{{ route('admin.dashboard.export.pdf') }}"
               class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
                📥 Export PDF
            </a>
        </div>



        {{-- ===========================
             GRAFIK
        =========================== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- LINE CHART --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-100">Grafik Pengaduan 6 Bulan</h3>
                <canvas id="lineChart"></canvas>
            </div>

            {{-- BAR --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-100">Grafik Bar Berdasarkan Status</h3>
                <canvas id="barChart"></canvas>
            </div>

            {{-- DONUT --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-100">Donut Chart Status (%)</h3>
                <canvas id="donutChart"></canvas>
            </div>

            {{-- BIDANG --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-100">Grafik Pengaduan Bidang</h3>
                <canvas id="bidangChart"></canvas>
            </div>

        </div>



        {{-- ===========================
             TABEL TERBARU
        =========================== --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow border border-gray-200 dark:border-gray-700">

            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">
                Pengaduan Terbaru per Bidang
            </h3>

            <table class="w-full table-auto border border-gray-300 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="p-2 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100">Bidang</th>
                        <th class="p-2 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100">Nama Warga</th>
                        <th class="p-2 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100">Status</th>
                        <th class="p-2 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100">Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $list = [
                            'egov' => 'E-Gov',
                            'itik' => 'ITIK',
                            'statistik' => 'Statistik',
                            'persandian' => 'Persandian',
                            'pikp' => 'PIKP',
                        ];
                    @endphp

                    @foreach ($list as $key => $label)
                        <tr class="bg-white dark:bg-gray-800">
                            <td class="p-2 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200 font-semibold">{{ $label }}</td>

                            @if ($latestPerBidang[$key])
                                <td class="p-2 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200">
                                    {{ $latestPerBidang[$key]->nama_warga }}
                                </td>
                                <td class="p-2 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200">
                                    {{ $latestPerBidang[$key]->status }}
                                </td>
                                <td class="p-2 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200">
                                    {{ $latestPerBidang[$key]->created_at->format('d M Y') }}
                                </td>
                            @else
                                <td colspan="3" class="p-2 border border-gray-300 dark:border-gray-700 text-gray-400 dark:text-gray-500 italic text-center">
                                    Tidak ada data pengaduan
                                </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

    </div>
</div>


{{-- ===========================
     CHART.JS
=========================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const isDark = document.documentElement.classList.contains("dark");

    const textColor = isDark ? "#e5e7eb" : "#1f2937";
    const gridColor = isDark ? "rgba(255,255,255,0.08)" : "rgba(0,0,0,0.1)";

    // LINE
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: @json($chartLine['labels']),
            datasets: [{
                label: "Total Pengaduan",
                data: @json($chartLine['values']),
                borderColor: "#4F46E5",
                backgroundColor: "rgba(79,70,229,0.2)",
                borderWidth: 3,
                tension: 0.4,
            }]
        },
        options: {
            scales: {
                x: { ticks: { color: textColor }, grid: { color: gridColor } },
                y: { ticks: { color: textColor }, grid: { color: gridColor } }
            },
            plugins: {
                legend: { labels: { color: textColor } }
            }
        }
    });

    // BAR
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: @json($chartBar['labels']),
            datasets: [{
                label: "Total",
                data: @json($chartBar['values']),
                backgroundColor: ["#f87171", "#fb923c", "#34d399"],
            }]
        },
        options: {
            scales: {
                x: { ticks: { color: textColor }, grid: { color: gridColor } },
                y: { ticks: { color: textColor }, grid: { color: gridColor } }
            },
            plugins: { legend: { labels: { color: textColor } } }
        }
    });

    // DONUT
    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: @json($chartDonut['labels']),
            datasets: [{
                data: @json($chartDonut['values']),
                backgroundColor: ["#f87171", "#fb923c", "#34d399"],
            }]
        },
        options: { plugins: { legend: { labels: { color: textColor } } } }
    });

    // BIDANG
    new Chart(document.getElementById('bidangChart'), {
        type: 'bar',
        data: {
            labels: @json($chartBidang['labels']),
            datasets: [{
                label: "Total",
                data: @json($chartBidang['values']),
                backgroundColor: "#6366f1",
            }]
        },
        options: {
            scales: {
                x: { ticks: { color: textColor }, grid: { color: gridColor } },
                y: { ticks: { color: textColor }, grid: { color: gridColor } }
            },
            plugins: { legend: { labels: { color: textColor } } }
        }
    });

});
</script>
