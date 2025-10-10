<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Absensi - {{ $participant->nama }}</title>
    <style>
        *{ font-family: DejaVu Sans, sans-serif; }
        body{ font-size:12px; color:#333; }
        h2{ margin:0 0 6px 0; }
        table{ width:100%; border-collapse:collapse; margin-top:8px; }
        th,td{ border:1px solid #ddd; padding:6px; font-size:12px; vertical-align:top; }
        th{ background:#f2f2f2; text-align:left; }
        .muted{ color:#777; }
    </style>
</head>
<body>
    <h2>Riwayat Absensi</h2>
    <p style="margin:0 0 10px 0;">
        <strong>Peserta:</strong> {{ $participant->nama }} ({{ $participant->nisnim }})<br>
        <strong>Instansi:</strong> {{ $participant->institute->nama_instansi ?? '-' }}
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:110px;">Tanggal</th>
                <th style="width:90px;">Status</th>
                <th style="width:85px;">Check-in</th>
                <th style="width:85px;">Check-out</th>
                <th>IP Masuk</th>
                <th>IP Pulang</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $ab)
                <tr>
                    <td>{{ optional($ab->date)->format('d-m-Y') }}</td>
                    <td>{{ $ab->status ?? '-' }}</td>
                    <td>
                        @if($ab->check_in_time)
                            {{ \Illuminate\Support\Carbon::parse($ab->check_in_time)->timezone('Asia/Jakarta')->format('H:i:s') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($ab->check_out_time)
                            {{ \Illuminate\Support\Carbon::parse($ab->check_out_time)->timezone('Asia/Jakarta')->format('H:i:s') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $ab->check_in_ip_address ?? '-' }}</td>
                    <td>{{ $ab->check_out_ip_address ?? '-' }}</td>
                    <td>{{ $ab->note ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;" class="muted">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
