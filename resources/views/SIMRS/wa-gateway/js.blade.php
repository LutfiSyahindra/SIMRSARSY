<script>
    function fetchQRCode() {
        fetch('/simrs/waGateway/wa/qr-get')
            .then(res => res.json())
            .then(data => {
                if (data.qr) {
                    const qrImg = document.getElementById('qr-image');
                    const qrStatus = document.getElementById('qr-status');

                    // Buat gambar QR dari teks QR
                    const qrUrl =
                        `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(data.qr)}&size=300x300`;
                    qrImg.src = qrUrl;
                    qrStatus.innerText = "Silakan scan QR code di WhatsApp Anda.";
                }
            })
            .catch(err => {
                console.error("❌ Gagal ambil QR code:", err);
            });
    }

    // Jalankan saat halaman siap dan ulangi tiap 5 detik
    fetchQRCode();
    setInterval(fetchQRCode, 5000);
</script>
