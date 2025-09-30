{{-- resources/views/atasan/peserta/pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Pembimbing</title>
    <style>
        *{ font-family: DejaVu Sans, sans-serif; }
        h2{ margin:0 0 10px 0; }
        table{ width:100%; border-collapse:collapse; }
        th,td{ border:1px solid #ddd; padding:6px; font-size:12px; }
        th{ background:#f2f2f2; text-align:left; }
    </style>
</head>
<body>
    <h2>Data Instansi</h2>
    @if($subtitle)<p style="margin-top:-6px;">{{ $subtitle }}</p>@endif
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Instansi</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $p)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $p->nama_instansi }}</td>
                <td>{{ $p->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
