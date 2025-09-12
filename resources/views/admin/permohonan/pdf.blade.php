<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Permohonan</title>
    <style>
        *{ font-family: DejaVu Sans, sans-serif; }
        h2{ margin:0 0 10px 0; }
        table{ width:100%; border-collapse:collapse; }
        th,td{ border:1px solid #ddd; padding:6px; font-size:12px; }
        th{ background:#f2f2f2; text-align:left; }
        .status-badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 11px;
        }
        .status-aktif { background: #d1fae5; color: #065f46; }
        .status-proses { background: #fef3c7; color: #92400e; }
        .status-selesai { background: #dbeafe; color: #1e40af; }
        .status-ditolak { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <h2>Data Permohonan</h2>
    @if($subtitle)<p style="margin-top:-6px;">{{ $subtitle }}</p>@endif
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Surat</th>
                <th>Tgl Masuk</th>
                <th>Instansi</th>
                <th>Jenis Magang</th>
                <th>Pembimbing</th>
                <th>Kontak</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $p)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $p->tgl_surat->format('d/m/Y') }}</td>
                <td>{{ $p->tgl_suratmasuk->format('d/m/Y') }}</td>
                <td>{{ $p->institute->nama_instansi ?? '-' }}</td>
                <td>{{ $p->jenis_magang }}</td>
                <td>{{ $p->pembimbing_sekolah }}</td>
                <td>{{ $p->kontak_pembimbing }}</td>
                <td>{{ $p->tgl_mulai->format('d/m/Y') }}</td>
                <td>{{ $p->tgl_selesai->format('d/m/Y') }}</td>
                <td>
                    <span class="status-badge status-{{ strtolower($p->status) }}">
                        {{ $p->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
