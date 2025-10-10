<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
    {{-- Meta tag ini akan me-redirect halaman setelah 3 detik --}}
    <meta http-equiv="refresh" content="3;url={{ $redirectUrl }}">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
            color: #5a5c69;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        .container {
            max-width: 500px;
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #e74a3b;
        }

        p {
            font-size: 1.2rem;
        }

        a {
            color: #4e73df;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>403 | Absen Gagal</h1>
        <p>{{ $message }}</p>
        <p>Jika halaman tidak beralih, <a href="{{ $redirectUrl }}">klik di sini</a>.</p>
    </div>
</body>

</html>
