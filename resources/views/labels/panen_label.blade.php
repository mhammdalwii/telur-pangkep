<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Label Batch {{ $panen->batch_code }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            text-align: center;
        }

        .label-container {
            border: 2px solid black;
            padding: 20px;
            width: 300px;
            margin: auto;
        }

        h1 {
            font-size: 18px;
            margin-top: 0;
        }

        p {
            margin: 5px 0;
        }

        .qr-code {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="label-container">
        <h1>Ayam Pangkep</h1>
        <p><strong>Kode Batch:</strong> {{ $panen->batch_code }}</p>
        <p><strong>Tgl. Panen:</strong> {{ \Carbon\Carbon::parse($panen->tanggal_panen)->format('d M Y') }}</p>
        <p><strong>Jenis:</strong> {{ $panen->jenis_produk }}</p>
        <div class="qr-code">
            <p><strong>Scan QR Code untuk lacak:</strong></p>
            {{-- URL di bawah ini bisa diganti ke halaman tracking publik nanti --}}
            {!! QrCode::size(150)->generate(url('/lacak/' . $panen->batch_code)) !!}
        </div>
        <p style="margin-top: 15px; font-size: 12px;">Lacak di website kami</p>
    </div>
</body>

</html>
