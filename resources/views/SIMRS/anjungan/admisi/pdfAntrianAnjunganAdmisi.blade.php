<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cetak Antrian</title>
        <style>
            @page {
                size: 80mm 150mm;
                margin: 10px;
            }

            .page-break {
                page-break-after: always;
            }
        </style>
    </head>

    <body>
        <h1>No. Antrian</h1>
        <p>{{ $nomor }}</p>

        <div class="page-break"></div> <!-- Halaman Baru -->

        <h1>No. Antrian</h1>
        <p>{{ $nomor }}</p>
    </body>

</html>
