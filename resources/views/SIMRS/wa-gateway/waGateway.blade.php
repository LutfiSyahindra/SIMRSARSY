@extends("template.partials._app")

@section("content")
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Petugas Panggil</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Petugas Panggil</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Poli</a></li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Scan QR WhatsApp</h5>
                    <div id="qr-container" class="my-3 text-center">
                        <img id="qr-image" src="" alt="QR Code" class="img-fluid" style="max-width: 300px;" />
                        <p id="qr-status" class="text-muted mt-2">Menunggu QR Code...</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" id="wa-user-info">

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div> <!-- end row-->
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>
@endsection

@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script>
        async function fetchQRCode() {
            try {
                const response = await fetch('http://192.168.2.168:3000/get-qr');
                const data = await response.json();

                const imgEl = document.getElementById('qr-image');
                const statusEl = document.getElementById('qr-status');

                if (data.status === 'success') {
                    statusEl.innerText = "Silakan scan QR di bawah ini";

                    QRCode.toDataURL(data.qr, {
                        width: 300
                    }, function(err, url) {
                        if (!err) {
                            imgEl.src = url;
                            imgEl.style.display = "block";
                        }
                    });

                } else if (data.status === 'connected') {
                    statusEl.innerText = "WhatsApp berhasil terkoneksi.";
                    imgEl.style.display = "none";
                } else {
                    statusEl.innerText = data.message;
                    imgEl.src = "";
                }

            } catch (err) {
                console.error(err);
                document.getElementById('qr-status').innerText = "Gagal menghubungi server Node.js";
            }
        }

        async function fetchUserInfo() {
            try {
                const response = await fetch('http://192.168.2.168:3000/get-user');
                const data = await response.json();
                const userInfoEl = document.getElementById('wa-user-info');
                console.log(data);
                if (data.status === 'success') {
                    const user = data.user;

                    userInfoEl.innerHTML = `
                   <div class="card shadow-sm border-0">
                    <div class="card-body bg-gradient bg-light rounded">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <h4 class="mb-0 ml-3">WhatsApp Login Info</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent px-0 py-1"><strong>👤 Nama:</strong> ${user.nama || '-'}</li>
                            <li class="list-group-item bg-transparent px-0 py-1"><strong>📞 Nomor:</strong> ${user.nomor}</li>
                            <li class="list-group-item bg-transparent px-0 py-1"><strong>🌐 Server:</strong> ${user.server}</li>
                            <li class="list-group-item bg-transparent px-0 py-1"><strong>📱 Platform:</strong> ${user.platform}</li>
                        </ul>
                    </div>
                </div>
                `;
                } else {
                    userInfoEl.innerHTML = '';
                }
            } catch (err) {
                console.error('Gagal mengambil info user:', err);
            }
        }
        fetchUserInfo();
        fetchQRCode();
        setInterval(fetchQRCode, 3000);
        setInterval(fetchUserInfo, 5000);
    </script>
@endsection
