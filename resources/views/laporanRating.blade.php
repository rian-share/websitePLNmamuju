<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan PLN Mamuju</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 30px;
        }

        /* ===== KOP SURAT ===== */
        .kop-container {
            position: relative;
            width: 100%;
            text-align: center;
        }

        .kop-logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 120px;
        }

        .kop-title {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .kop-subtitle {
            font-size: 13px;
            margin: 2px 0;
        }

        .kop-address {
            font-size: 11px;
            margin: 2px 0;
        }

        .kop-line-bold {
            border-top: 3px solid black;
            margin-top: 15px;
        }

        .kop-line-thin {
            border-top: 1px solid black;
            margin-top: 2px;
            margin-bottom: 20px;
        }

        /* ===== JUDUL ===== */
        .judul {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 20px;
            text-decoration: underline;
        }

        /* ===== TABEL ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
        }

        th {
            text-align: center;
            background-color: #f2f2f2;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
        }

        /* ===== TANDA TANGAN ===== */
        .ttd-area {
            margin-top: 50px;
            width: 100%;
        }

        .ttd {
            width: 40%;
            float: right;
            text-align: center;
        }

        .clear {
            clear: both;
        }

        /* ===== NOMOR HALAMAN ===== */
        .page-number {
            position: fixed;
            bottom: -30px;
            right: 0;
            font-size: 10px;
        }

        .page-number:before {
            content: "Halaman " counter(page);
        }
    </style>
</head>

<body>

    <!-- NOMOR HALAMAN -->
    <div class="page-number"></div>

    <!-- ===== KOP SURAT ===== -->
    <div class="kop-container">

        <!-- Logo kiri (aktifkan jika ada file logo) -->
        <img src="{{ public_path('svg/1661781006-removebg-preview (1).svg') }}" class="kop-logo">

        <p class="kop-title">PT PLN (PERSERO)</p>
        <p class="kop-subtitle">UID SULSELRABAR</p>
        <p class="kop-subtitle">UP3 MAMUJU</p>
        <p class="kop-subtitle">ULP MANAKARRA</p>
        <p class="kop-address">
            Jl. Sultan Hasanuddin No. 43, Binanga, Kec.Mamuju, Kab.Mamuju, Sulawesi Barat<br>
            Telp: (123) | W: www.pln.co.id
        </p>

    </div>

    <div class="kop-line-bold"></div>
    <div class="kop-line-thin"></div>

    <div class="judul">
        LAPORAN KUNJUNGAN DAN RENSPONSE PELANGGAN TERHADAP LAYANAN
    </div>

    <p>
        Laporan ini dibuat sebagai bentuk dokumentasi dan rekapitulasi data pelanggan
        PT PLN (Persero) UP3 Mamuju.
    </p>

    <br>

    <table>
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="30%">Kode Kunjungan</th>
                <th width="30%">Pembuat Kunjungan</th>
                <th width="20%">Tujuan Kunjungan</th>
                <th width="15%">Status Kunjungan</th>
                <th width="15%">Rating</th>
                <th width="15%">Kategori</th>
                <th width="15%">Komentar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d )
                <tr>
                <td align="center">{{ $d->id }}</td>
                <td align="center">{{ $d->kunjungan->kode_kunjungan }}</td>
                <td align="center">{{ $d->kunjungan->petugas->nama }}</td>
                <td align="center">{{ $d->kunjungan->tujuan_kunjungan }}</td>
                <td align="center">{{ $d->kunjungan->status }}</td>
                <td align="center">{{ $d->rating }}</td>
                <td align="center">{{ $d->kategori }}</td>
                <td align="center">{{ $d->komentar }}</td>
            </tr> 
            @endforeach
        </tbody>
    </table>

    <div class="ttd-area">
        <div class="ttd">
            Mamuju, {{ date('d F Y') }} <br>
            Petugas <br><br><br><br>
            <b>(...................................)</b>
        </div>
        <div class="clear"></div>
    </div>

</body>

</html>
