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

            .queue-box,
            .video-box {
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
            }

            .queue-box .number {
                font-size: 64px;
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
        <div class="header">
            <img src="{{ asset("img/logoarsy.png") }}" alt="Logo RS" class="logo">

            <div class="header-text">
                <h1>ANTRIAN LOKET PIPP</h1>
                <h3>RS ABDURRAHMAN SYAMSYURI</h3>
            </div>

            <!-- Tombol Fullscreen -->
            <button class="fullscreen-btn btn btn-primary" id="fullscreen-btn">
                <i class="ri-fullscreen-line fs-22"></i>
            </button>
        </div>

        <!-- Container -->
        <div class="container">
            <!-- Display Nomor Antrian -->
            <div class="main-display">
                <div class="queue-box">
                    <p class="number">-</p>
                    <h3 class="name">-</h3>
                </div>
                {{-- <div class="video-box">
                    <video controls>
                        <source src="{{ Storage::url("video/bpjs.mp4") }}" type="video/mp4">
                    </video>
                </div> --}}
            </div>

            <!-- Daftar Customer Service -->
            {{-- <div class="customer-services-container">
                <div class="customer-services" id="customer-services">
                    <!-- Kotak akan di-generate menggunakan jQuery -->
                </div>
            </div> --}}
            {{-- <button id="enableSpeech">Aktifkan Suara</button> --}}
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://js.pusher.com/8.0/pusher.min.js"></script>
        <!-- Vendor js -->
        <script src="{{ asset("dist/assets/js/vendor.min.js") }}"></script>

        <!-- Daterangepicker js -->
        <script src="{{ asset("dist/assets/vendor/daterangepicker/moment.min.js") }}"></script>
        <script src="{{ asset("dist/assets/vendor/daterangepicker/daterangepicker.js") }}"></script>
        <!-- Vector Map js -->
        <script src="{{ asset("dist/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js") }}">
        </script>
        <script
            src="{{ asset("dist/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js") }}">
        </script>

        <!-- App js -->
        <script src="{{ asset("dist/assets/js/app.min.js") }}"></script>

        <script>
            $(document).ready(function() {
                const pusher = new Pusher("{{ env("PUSHER_APP_KEY") }}", {
                    cluster: "{{ env("PUSHER_APP_CLUSTER") }}",
                    forceTLS: true
                });

                document.getElementById('fullscreen-btn').addEventListener('click', function() {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen();
                    } else {
                        document.exitFullscreen();
                    }
                });


                // Subscribe ke channel
                const channel = pusher.subscribe("panggilan-pipp");
                let lastQueueNumber = null; // Menyimpan nomor antrean terakhir yang diproses
                let queueList = []; // Antrian untuk suara dan tampilan
                let isSpeaking = false; // Status apakah sedang berbicara
                let calledQueueList = [];
                let isUserInteracted = false; // Status apakah pengguna sudah berinteraksi

                // Deteksi interaksi pertama pengguna (klik atau sentuhan di layar)
                document.addEventListener("click", function() {
                    isUserInteracted = true;
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Antrian siap dipanggil"
                    });
                    console.log("✅ Pengguna pertama kali berinteraksi. Antrian PIPP siap dipanggil.");
                }, {
                    once: true
                }); // Hanya perlu dijalankan sekali

                channel.bind("PanggilPIPP", function(data) {
                    console.log("Data diterima dari Pusher (PIPP):", data);

                    // Pastikan data memiliki properti yang diharapkan
                    if (data && data.nomorAntrian && data.dokter && data.poli && data.nama) {
                        let formattedData = {
                            no_reg: data.nomorAntrian,
                            nm_dokter: data.dokter,
                            nm_poli: data.poli,
                            nm_pasien: data.nama,
                            noRawat: data.noRawat,
                        };

                        // Tambahkan ke antrian hanya jika belum ada dalam queueList
                        if (!queueList.some(q => q.no_reg ===
                                formattedData.no_reg)) {
                            queueList.push(formattedData);
                            calledQueueList.push(formattedData);
                            updateCustomerServices();
                            processQueue(); // Mulai proses antrean jika belum berjalan
                        }
                    } else {
                        console.error("Data tidak valid setelah konversi:", data);
                    }
                });

                function processQueue() {
                    if (!isUserInteracted) return; // Tunggu sampai ada interaksi pengguna
                    if (isSpeaking || queueList.length === 0) return;

                    isSpeaking = true;
                    let row = queueList.shift(); // Ambil antrean pertama dari daftar
                    lastQueueNumber = row.no_reg;
                    updateDisplay(row);
                    speakQueue(row.nm_dokter, row.nm_poli, row.no_reg, row.nm_pasien);
                }

                function updateDisplay(row) {
                    $(".queue-box .number").text(row.nm_pasien);
                    $(".queue-box .name").text(row.noRawat)
                }

                function formatPronunciation(dokter) {
                    let replacements = {
                        "Sp. PD": "espe, pede",
                        "Sp. A": "espe, a",
                        "Sp. B": "espe, be",
                        "Sp. KK": "espe, ka, ka",
                        "dr.": "dokter",
                        "drg.": "dokter gigi"
                    };

                    for (let key in replacements) {
                        dokter = dokter.replace(new RegExp(key, "gi"), replacements[key]);
                    }

                    return dokter;
                }

                function formatPatientName(pasien) {
                    let replacements = {
                        "Tn": "Tuan",
                        "Ny": "Nyonya"
                    };

                    for (let key in replacements) {
                        pasien = pasien.replace(new RegExp(`\\b${key}\\.?\\b`, "gi"), replacements[key]);
                    }

                    let match = pasien.match(/(.*),\s*(Tuan|Nyonya)/i);
                    if (match) {
                        pasien = `${match[2]}. ${match[1]}`;
                    }

                    // Ubah nama kapital semua menjadi format normal
                    pasien = pasien.toLowerCase().replace(/\b\w/g, c => c.toUpperCase());

                    return pasien;
                }


                function speakQueue(dokter, poli, nomor, pasien) {
                    if ('speechSynthesis' in window) {
                        let formattedDokter = formatPronunciation(dokter);
                        let formattedPasien = formatPatientName(pasien);
                        let text =
                            `Pasien atas nama: ${formattedPasien}, Silahkan ke Loket P I Pepe`;
                        let speech = new SpeechSynthesisUtterance(text);
                        speech.lang = "id-ID";
                        speech.rate = 0.8;
                        speech.pitch = 1;

                        speech.onend = function() {
                            isSpeaking = false;
                            processQueue();
                        };

                        window.speechSynthesis.cancel();
                        window.speechSynthesis.speak(speech);
                    } else {
                        console.error("Browser tidak mendukung Text-to-Speech!");
                    }
                }


                function updateCustomerServices() {
                    let container = $('#customer-services');
                    container.empty();

                    const colors = ['#109191'];
                    let serviceMap = new Map();

                    calledQueueList.forEach(item => {
                        let key = `${item.nm_poli}-${item.nm_dokter}`;

                        // Jika poli dan dokter sudah ada, update nomor antrian & pasien
                        if (serviceMap.has(key)) {
                            let existing = serviceMap.get(key);
                            existing.no_reg = item.no_reg;
                            existing.nm_pasien = item.nm_pasien;
                        } else {
                            serviceMap.set(key, {
                                ...item
                            });
                        }
                    });

                    let serviceBoxes = Array.from(serviceMap.values()).map((item, index) => {
                        let color = colors[index % colors.length];
                        return `
                    <div class="service-box" style="background-color: ${color};">
                        <h3 class="service-doctor">${item.nm_dokter || 'N/A'}</h3>
                        <h3>${item.nm_poli || 'UNKNOWN SERVICE'}</h3>
                        <h3 class="service-number">${item.no_reg || 'N/A'}</h3>
                        <h3 class="service-number">${item.nm_pasien || 'N/A'}</h3>
                    </div>`;
                    }).join('');

                    container.html(serviceBoxes);

                    if (serviceMap.size >= 3) {
                        container.addClass("scroll-active");
                    } else {
                        container.removeClass("scroll-active");
                    }

                }

                // Panggil fungsi setelah perubahan data
                updateCustomerServices();

            });
        </script>
    </body>

</html>
{{-- tes --}}
{{-- tes --}}
