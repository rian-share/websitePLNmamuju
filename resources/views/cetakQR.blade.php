<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>ID Card PLN</title>

    <style>
        @page {
            margin: 12px;
        }

        /* WAJIB agar height:100% bekerja */
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            background: #ffffff;
            font-family: Arial, sans-serif;

            /* INI yang bikin card ketengah kertas */
            display: flex;
            justify-content: center;
            /* tengah horizontal */
            align-items: center;
            /* tengah vertical */
        }

        .page {
            width: 100%;
            text-align: center;
            /* border: solid; */
            margin-top: 150px
        }

        .card-container {
            display: inline-block;
            text-align: left;
        }

        .card-inner {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            padding-bottom: 16px;

            display: flex;
            flex-direction: column;
            align-items: center;

            /* supaya dompdf tidak pecah halaman */
            page-break-inside: avoid;
        }

        .header {
            width: 100%;
            padding: 12px 0 8px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pln-logo-img {
            width: 220px;
            height: 80px;
            object-fit: contain;
        }

        .title-strip {
            width: 100%;
            background-color: #2D8FA5;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            padding: 6px 0;
        }

        .yellow-line {
            width: 100%;
            height: 4px;
            background-color: #FFEA00;
            margin-bottom: 10px;
        }

        .qr-section {
            margin-top: 18px;
            background-color: #BFDEE4;
            padding: 10px 10px 6px 10px;
            border-radius: 12px;
            text-align: center;
            width: 180px;
            margin-left: auto;
            margin-right: auto;
        }

        .qr-image {
            width: 140px;
            height: 140px;
            border-radius: 4px;
        }

        .qr-code-text {
            font-weight: bold;
            font-size: 14px;
            color: #333;
            margin-top: 6px;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .name {
            margin-top: 10px;
            font-size: 18px;
            font-weight: 800;
            color: #1a1a1a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
        }

        .bumn-container {
            margin-top: 10px;
            width: 120px;
            margin-left: auto;
            margin-right: auto;
        }

        .bumn-img {
            width: 100%;
            height: auto;
        }

        .divider {
            width: 90%;
            height: 1px;
            background-color: #ddd;
            margin-top: 14px;
            margin-bottom: 10px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-text {
            color: #2D8FA5;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="page">
        <div class="card-container">
            <div class="card-inner">

                <div class="header">
                    <img src="{{ public_path('img/Logo_PLN.svg.png') }}" alt="Logo PLN" class="pln-logo-img">
                </div>

                <div class="title-strip">Kartu Identitas Petugas</div>
                <div class="yellow-line"></div>

                <div class="qr-section">
                    <!-- SVG base64 yang benar -->
                    <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code" class="qr-image">
                    <div class="qr-code-text">{{ $data->role }}</div>
                </div>

                <div class="name">{{ $data->nama }}</div>

                <div class="bumn-container">
                    <img src="{{ public_path('img/Logo_BUMN_Untuk_Indonesia_2020.svg.png') }}"
                        alt="BUMN Untuk Indonesia" class="bumn-img">
                </div>

                <div class="divider"></div>
                <div class="footer-text">UP3 & ULP MAMUJU</div>

            </div>
        </div>
    </div>

</body>

</html>
