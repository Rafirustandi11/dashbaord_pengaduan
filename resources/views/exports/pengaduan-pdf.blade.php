<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Pengaduan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 0;
            font-size: 20px;
            font-weight: bold;
        }

        p.sub {
            text-align: center;
            margin-top: 4px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        th, td {
            border: 1px solid #999;
            padding: 7px;
            font-size: 11px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        footer {
            position: fixed;
            bottom: -5px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            color: #666;
        }

        header {
            position: fixed;
            top: -10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
        }
    </style>
</head>
<body>

<header>
    <strong>DKIS - Sistem Pengaduan Warga</strong>
</header>

<h2>Laporan Rekap Pengaduan</h2>

<p class="sub">
    Bidang: <strong>{{ $bidang ?? 'Semua Bidang' }}</strong> |
    Status: <strong>{{ $status ?? 'Semua Status' }}</strong>
</p>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="18%">Nama Warga</th>
            <th width="15%">Kategori</th>
            <th width="15%">Bidang Tujuan</th>
            <th width="12%">Status</th>
            <th width="15%">Tanggal Masuk</th>
            <th width="15%">Tanggal Selesai</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($pengaduans as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->nama_warga }}</td>
                <td>{{ $p->kategori }}</td>
                <td>{{ $p->bidang_tujuan }}</td>
                <td>{{ ucfirst($p->status) }}</td>

                {{-- Tanggal Masuk --}}
                <td>
                    {{ $p->created_at ? $p->created_at->timezone('Asia/Jakarta')->format('d M Y') : '-' }}
                </td>

                {{-- Tanggal Selesai --}}
                <td>
                    {{ $p->tanggal_selesai ? \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') : '-' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<footer>
    Dicetak pada: {{ now()->timezone('Asia/Jakarta')->format('d M Y H:i') }}
</footer>

</body>
</html>
