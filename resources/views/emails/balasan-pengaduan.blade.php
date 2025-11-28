<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Balasan Pengaduan</title>

    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 0;
            margin: 0;
        }

        .container {
            max-width: 650px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            padding: 25px;
            color: white;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }

        .content {
            padding: 30px 35px;
            color: #374151;
            font-size: 15px;
            line-height: 1.65;
        }

        .content p {
            margin: 12px 0;
        }

        .box {
            background: #f9fafb;
            border-left: 4px solid #2563eb;
            padding: 15px;
            margin-top: 10px;
            border-radius: 6px;
        }

        .label {
            font-weight: 600;
            color: #111827;
            margin-bottom: 6px;
            display: block;
        }

        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            background: #e0f2fe;
            color: #0369a1;
            font-size: 13px;
            border-radius: 20px;
            font-weight: 600;
            margin-top: 10px;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="header">
            <h2>Balasan atas Pengaduan Anda</h2>
        </div>

        <div class="content">

            <p>Halo <strong>{{ $pengaduan->nama_warga }}</strong>,</p>

            <p>Terima kasih telah menyampaikan laporan Anda melalui Sistem Pengaduan Warga.</p>

            <span class="label">📌 Isi Laporan Anda:</span>
            <div class="box">
                {{ $pengaduan->isi_laporan }}
            </div>

            @if ($pengaduan->balasan)
                <span class="label">💬 Balasan dari Admin:</span>
                <div class="box">
                    {{ $pengaduan->balasan }}
                </div>
            @endif

            @if ($pengaduan->tanggapan_bidang)
                <span class="label">🏢 Balasan dari Bidang ({{ ucfirst($pengaduan->bidang_tujuan) }}):</span>
                <div class="box">
                    {{ $pengaduan->tanggapan_bidang }}
                </div>
            @endif

            <p>Status pengaduan Anda saat ini:</p>
            <div class="status">
                {{ $pengaduan->status }}
            </div>

            <p style="margin-top:18px;">
                Pengaduan dibuat pada:
                <strong>{{ $pengaduan->created_at->format('d F Y, H:i') }}</strong>
            </p>

            <p>Terima kasih atas partisipasi Anda dalam meningkatkan pelayanan publik.</p>

            <p>Hormat kami,<br>
                <strong>Diskominfo Kota Cirebon – Sistem Pengaduan Warga</strong>
            </p>

        </div>

        <div class="footer">
            Email ini dikirim otomatis oleh sistem. Mohon tidak membalas langsung email ini.
        </div>

    </div>

</body>

</html>
