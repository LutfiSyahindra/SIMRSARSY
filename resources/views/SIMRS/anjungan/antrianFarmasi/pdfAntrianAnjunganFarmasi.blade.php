<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cetak Antrian</title>
        <style>
            @page {
                size: 80mm 70mm;
                margin: 5px;
            }

            body {
                text-align: center;
                font-family: Arial, sans-serif;
                font-size: 14px;
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
                padding: 5px 0;
            }

            h3 {
                margin: 5px 0;
                font-size: 18px;
                font-weight: bold;
            }

            h4 {
                margin: 3px 0;
                font-size: 16px;
            }

            p {
                margin: 2px 0;
                font-size: 14px;
            }

            .nomor-antrian {
                font-size: 28px;
                font-weight: bold;
                margin: 10px 0;
                border: 2px solid black;
                display: inline-block;
                padding: 5px 10px;
                border-radius: 5px;
            }

            .divider {
                border-top: 1px dashed black;
                margin: 8px 0;
            }

            .page-break {
                page-break-after: always;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h3>FASKES TINGKAT LANJUT</h3>
            <h4>RS ARSY PACIRAN</h4>
            <p><strong>{{ $tgl_peresepan }}</strong> | <strong>{{ $jam_peresepan }}</strong></p>
            <div class="nomor-antrian">{{ $nomor }}</div>
            <h4>ANTRIAN FARMASI RAWAT JALAN</h4>
        </div>

        <div class="page-break"></div> <!-- Halaman Baru -->

        <div class="container">
            <h3>FASKES TINGKAT LANJUT</h3>
            <h4>RS ARSY PACIRAN</h4>
            <p><strong>{{ $tgl_peresepan }}</strong> | <strong>{{ $jam_peresepan }}</strong></p>
            <div class="nomor-antrian">{{ $nomor }}</div>
            <h4>ANTRIAN FARMASI RAWAT JALAN</h4>
        </div>
    </body>

</html>
