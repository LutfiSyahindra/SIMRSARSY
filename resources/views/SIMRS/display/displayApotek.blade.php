<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Display Antrian</title>
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset("dist/assets/images/favicon.ico") }}">

        <!-- Daterangepicker css -->
        <link rel="stylesheet" href="{{ asset("dist/assets/vendor/daterangepicker/daterangepicker.css") }}">

        <!-- Vector Map css -->
        <link rel="stylesheet"
            href="{{ asset("dist/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css") }}">

        <!-- Theme Config Js -->
        <script src="{{ asset("dist/assets/js/config.js") }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- App css -->
        <link href="{{ asset("dist/assets/css/app.min.css") }}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="{{ asset("dist/assets/css/icons.min.css") }}" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                flex-direction: column;
            }

            .header {
                position: relative;
                background-color: #097c99;
                color: white;
                text-align: center;
                padding: 15px 20px;
            }

            .header .logo {
                position: absolute;
                left: 20px;
                /* Sesuaikan posisi logo */
                top: 50%;
                transform: translateY(-50%);
                width: 100px;
                /* Sesuaikan ukuran logo */
                height: auto;
            }

            .header-text {
                display: inline-block;
            }

            .fullscreen-btn {
                position: absolute;
                top: 10px;
                right: 20px;
                /* Geser ke kanan atas */
                background-color: #097c99;
                border: none;
                padding: 8px 12px;
                cursor: pointer;
            }

            .fullscreen-btn i {
                font-size: 60px;
                color: white;
            }

            .container {
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                max-width: 1500px;
                margin: 0 auto;
                padding: 10px;
                width: 100%;
                box-sizing: border-box;
            }

            .main-display {
                display: flex;
                gap: 20px;
                flex-grow: 1;
            }

            .queue-box {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background-color: #109191;
                color: white;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                position: relative;
            }

            .queue-box h1:first-child {
                position: absolute;
                top: 5px;
                /* Geser ke atas */
                left: 50%;
                /* Pusatkan secara horizontal */
                transform: translateX(-50%);
                /* Koreksi posisi agar tepat di tengah */
                font-size: 30px;
                /* Sesuaikan ukuran */
                font-weight: bold;
                color: #ffffff;
                /* Warna merah untuk menonjolkan teks */
            }

            .table-box {
                flex: 1;
                background-color: #109191;
                color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
                text-align: center;
                min-width: 350px;
            }

            .table-container {
                overflow-x: auto;
            }

            .table-box table tbody td {
                color: #ffffff;
                /* Warna font isi tabel */
            }

            .table-box table thead th {
                color: #ffffff;
                /* Warna font isi tabel */
            }

            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 18px;
            }

            thead th {
                background-color: #007bff;
                color: white;
                padding: 10px;
                text-align: center;
                font-size: 20px;
            }

            tbody td {
                padding: 10px;
                text-align: center;
                font-weight: bold;
            }

            .queue-box .number {
                font-weight: bold;
            }

            .video-box video {
                width: 100%;
                border-radius: 10px;
            }

            .customer-services-container {
                width: 100%;
                position: relative;
                padding-top: 10px;
            }

            .customer-services {
                display: flex;
                gap: 5px;
                width: max-content;
                /* animation: scrollAnimation 20s linear infinite; */
            }

            .scroll-active {
                display: flex;
                gap: 5px;
                width: max-content;
                animation: scrollAnimation 20s linear infinite;
            }

            /* Jika tidak ada kelas scroll-active, animasi berhenti */
            .customer-services {
                display: flex;
                gap: 5px;
                width: max-content;
            }

            .service-box {
                flex: 0 0 12%;
                padding: 10px;
                border-radius: 8px;
                text-align: center;
                font-size: 14px;
                color: white;
                white-space: nowrap;
                background-color: #003366;
            }

            @keyframes scrollAnimation {
                from {
                    transform: translateX(0);
                }

                to {
                    transform: translateX(-50%);
                }
            }

            @media (max-width: 768px) {
                .main-display {
                    flex-direction: column;
                }
            }
        </style>
    </head>

    <body>
        <!-- Header -->
        <!-- Header -->
        <div class="header">
            <img src="{{ asset("img/logoarsy.png") }}" alt="Logo RS" class="logo">

            <div class="header-text">
                <h1>ANTRIAN INSTALASI FARMASI RAWAT JALAN</h1>
                <h3>RS ABDURRAHMAN SYAMSYURI</h3>
            </div>

            <!-- Tombol Fullscreen -->
            <button class="fullscreen-btn btn btn-primary" id="fullscreen-btn">
                <i class="ri-fullscreen-line fs-22"></i>
            </button>
        </div>

        <!-- Container -->
        <div class="container">
            <div class="customer-services-container">
                <div class="queue-box">
                    <h1>ANTREAN DIPANGGIL</h1>
                    <br>
                    <br>
                    <h2 class="name">-</h2>
                    <h1 class="number">-</h1>
                </div>
            </div>
            <br>
            <!-- Display Nomor Antrian -->
            <div class="main-display d-flex flex-wrap">
                <div class="table-box">
                    <h1>NON RACIKAN</h1>
                    <div class="table-container table-responsive">
                        <table id="fixed-header-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-box">
                    <h1>RACIKAN</h1>
                    <div class="table-container table-responsive">
                        <table id="fixed-header-datatable-2" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Daftar Customer Service -->

            <script src="https://code.responsivevoice.org/responsivevoice.js"></script>
            <script>
                $(document).ready(function() {
                    let lastDisplayedPatient = "";
                    let isSpeaking = false;
                    let isUserInteracted = false;

                    // Event pertama kali user berinteraksi
                    document.addEventListener("click", function() {
                        isUserInteracted = true;
                        Swal.fire({
                            icon: "success",
                            title: "Antrian siap dipanggil",
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                        console.log("✅ Pengguna pertama kali berinteraksi. Antrian siap dipanggil.");
                    }, {
                        once: true
                    });

                    // Fullscreen toggle
                    $("#fullscreen-btn").on("click", function() {
                        if (!document.fullscreenElement) {
                            document.documentElement.requestFullscreen();
                        } else {
                            document.exitFullscreen();
                        }
                    });

                    // Cek apakah responsiveVoice tersedia
                    window.onload = function() {
                        if (typeof responsiveVoice !== "undefined") {
                            console.log("✅ responsiveVoice terdeteksi!");
                        } else {
                            console.error("❌ responsiveVoice tidak terdeteksi!");
                        }
                    };

                    // Fetch antrean dengan async/await untuk meningkatkan performa
                    async function fetchQueueData() {
                        if (isSpeaking || !isUserInteracted) return;

                        try {
                            let response = await $.ajax({
                                url: "{{ route("display.panggilapotek") }}",
                                method: "GET",
                                headers: {
                                    "X-Requested-With": "XMLHttpRequest"
                                }
                            });

                            console.log("Data yang diterima:", response);

                            if (response.length > 0) {
                                let data = response[0]; // Ambil pasien pertama dalam antrean
                                let formattedName = toTitleCase(data.nm_pasien);

                                if (lastDisplayedPatient !== formattedName) {
                                    $(".queue-box .number").text(formattedName);
                                    $(".queue-box .name").text(data.no_rawat);
                                    lastDisplayedPatient = formattedName;
                                }

                                callPatient(formattedName, data.no_rawat, data.panggil);
                            }
                        } catch (error) {
                            console.error("❌ Gagal mengambil antrean:", error);
                        }
                    }

                    // Memanggil pasien dengan suara
                    function callPatient(name, number, panggil) {
                        let text = `Pasien atas nama ${name}, silakan menuju loket pengambilan obat.`;
                        let bellSound = new Audio(
                            "{{ asset("plugins/audio/Airport_Bell.mp3") }}"); // Ganti dengan path suara bel

                        isSpeaking = true;

                        // Putar suara bel terlebih dahulu
                        bellSound.play();

                        // Setelah bel selesai, panggil pasien
                        bellSound.onended = function() {
                            responsiveVoice.speak(text, "Indonesian Female", {
                                pitch: 1,
                                rate: 0.9,
                                volume: 1,
                                onend: async function() {
                                    isSpeaking = false;
                                    try {
                                        let response = await $.ajax({
                                            url: "{{ route("display.updateapotek") }}",
                                            method: "PUT",
                                            data: {
                                                panggil: panggil
                                            },
                                            headers: {
                                                "X-Requested-With": "XMLHttpRequest",
                                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                            }
                                        });
                                        console.log("✅ Status antrean diperbarui:", response);
                                    } catch (error) {
                                        console.error("❌ Gagal memperbarui status antrean:", error);
                                    }
                                }
                            });
                        };
                    }


                    // Fungsi untuk mengubah teks ke Title Case
                    function toTitleCase(str) {
                        return str.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
                    }

                    // Fungsi generik untuk load data tabel dengan efek sliding
                    async function loadTableData(route, tableSelector) {
                        let response = []; // Menyimpan data dari server
                        let batchSize = 5; // Jumlah data per batch
                        let index = 0;

                        async function fetchData() {
                            try {
                                let newData = await $.ajax({
                                    url: route,
                                    method: "GET",
                                    dataType: "json"
                                });

                                response = newData; // Update data terbaru
                                index = 0; // Reset ke batch pertama setelah update
                            } catch (error) {
                                console.error(`❌ Terjadi kesalahan dalam memuat ${tableSelector}:`, error);
                            }
                        }

                        function showNextBatch() {
                            let tableBody = $(`${tableSelector} tbody`);
                            tableBody.empty(); // Hapus batch sebelumnya

                            let batch = response.slice(index, index + batchSize); // Ambil 6 data
                            if (batch.length === 0) {
                                index = 0; // Reset ke awal jika sudah sampai akhir
                                batch = response.slice(index, index + batchSize);
                            }

                            batch.forEach(item => {
                                let row = `<tr style="display: none;">
                                    <td>${item.no_rawat}</td>
                                    <td>${item.nm_pasien}</td>
                                    <td>${item.status}</td>
                                </tr>`;
                                tableBody.append(row);
                            });

                            tableBody.find("tr").fadeIn(800);

                            index += batchSize; // Pindah ke batch berikutnya
                        }

                        await fetchData(); // Ambil data pertama kali
                        showNextBatch(); // Tampilkan batch pertama

                        // Ganti batch setiap 5 detik
                        setInterval(showNextBatch, 5000);

                        // Perbarui data dari server setiap 10 detik
                        setInterval(fetchData, 10000);
                    }

                    // Jalankan fungsi pertama kali
                    loadTableData("{{ route("display.nonracikan") }}", "#fixed-header-datatable");
                    loadTableData("{{ route("display.racikan") }}", "#fixed-header-datatable-2");


                    fetchQueueData();
                    setInterval(fetchQueueData, 2000);
                });
            </script>

    </body>

</html>
