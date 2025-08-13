<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Label Batch {{ $eggBatch->batch_code }}</title>
    <style>
        /* Gaya CSS sederhana untuk PDF */
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
        <h1>Telur Pangkep</h1>
        <p><strong>Kode Batch:</strong> {{ $eggBatch->batch_code }}</p>
        <p><strong>Tgl. Produksi:</strong> {{ $eggBatch->production_date->format('d M Y') }}</p>
        <p><strong>Kualitas:</strong> {{ $eggBatch->quality }}</p>
        <div class="qr-code">
            {{-- Di sini kita akan generate QR Code --}}
            {!! QrCode::size(150)->generate(route('home')) !!}
            {{-- Untuk sementara, QR Code mengarah ke halaman utama --}}
        </div>
        <p style="margin-top: 15px; font-size: 12px;">Lacak di telur-pangkep.com</p>
    </div>
</body>

</html>
