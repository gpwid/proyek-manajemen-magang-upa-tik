{{-- resources/views/admin/peserta/pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Peserta</title>
    <style>
        *{ font-family: DejaVu Sans, sans-serif; }
        h2{ margin:0 0 10px 0; }
        table{ width:100%; border-collapse:collapse; }
        th,td{ border:1px solid #ddd; padding:6px; font-size:12px; }
        th{ background:#f2f2f2; text-align:left; }
    </style>
</head>
<body>
    <h2>Data Peserta</h2>
    @if($subtitle)<p style="margin-top:-6px;">{{ $subtitle }}</p>@endif
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>NISN/NIM</th>
                <th>Jenis Kelamin</th>
                <th>Jurusan</th>
                <th>Kontak</th>
                <th>Tahun Aktif</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $p)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->nik }}</td>
                <td>{{ $p->nisnim }}</td>
                <td>{{ $p->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $p->jurusan }}</td>
                <td>{{ $p->kontak_peserta }}</td>
                <td>{{ $p->tahun_aktif }}</td>
                <td>{{ $p->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
