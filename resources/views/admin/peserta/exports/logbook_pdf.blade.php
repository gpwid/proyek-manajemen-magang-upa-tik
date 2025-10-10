<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Logbook - {{ $participant->nama }}</title>
    <style>
        *{ font-family: DejaVu Sans, sans-serif; }
        h2{ margin:0 0 6px 0; }
        table{ width:100%; border-collapse:collapse; }
        th,td{ border:1px solid #ddd; padding:6px; font-size:12px; vertical-align: top; }
        th{ background:#f2f2f2; text-align:left; }
    </style>
</head>
<body>
    <h2>Riwayat Logbook</h2>
    <p style="margin:0 0 10px 0;"><strong>Peserta:</strong> {{ $participant->nama }} ({{ $participant->nisnim }})</p>
    <table>
        <thead>
            <tr>
                <th style="width:110px;">Tanggal</th>
                <th style="width:35%;">Tugas/Dikerjakan</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logbooks as $lb)
                <tr>
                    <td>{{ optional($lb->date)->format('d-m-Y') }}</td>
                    <td>{{ $lb->tasks_completed }}</td>
                    <td>{{ $lb->description }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
