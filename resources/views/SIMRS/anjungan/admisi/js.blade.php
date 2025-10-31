<script>
    $(document).ready(function() {
        $("#ambilNomorAdmisi").click(function() {
            $.ajax({
                url: '{{ route("anjungan.admisi.generateNoAntrian") }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('RESP', response);

                    if (response.status === "success") {
                        // Ambil nilai nomor dengan fallback
                        var nomorObj = response.nomor_antrian || {};
                        var nomor = nomorObj.no_antrian ?? nomorObj.nomor_antrian ??
                            nomorObj;
                        // penjelasan: kebijakan fallback jika key berbeda

                        Swal.fire({
                            title: "Nomor Antrian Anda",
                            text: "Nomor: " + nomor,
                            icon: "success"
                        }).then(() => {
                            $("#exampleModal").modal("hide");

                            // Pastikan urlCetak gunakan nilai, bukan objek
                            let urlCetak =
                                '{{ url("simrs/anjungan/admisi/cetakAntrian") }}/' +
                                nomor;
                            let newWindow = window.open(urlCetak, "_blank");

                            if (newWindow) {
                                newWindow.print();

                                newWindow.onafterprint = function() {
                                    Swal.fire({
                                        title: "Cetak Ulang?",
                                        text: "Apakah Anda ingin mencetak lagi?",
                                        icon: "question",
                                        showCancelButton: true,
                                        confirmButtonText: "Ya, Cetak Lagi",
                                        cancelButtonText: "Tidak"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            newWindow.print();
                                        } else {
                                            newWindow.close();
                                        }
                                    });
                                };
                            } else {
                                alert(
                                    "Popup diblokir! Izinkan pop-up untuk cetak otomatis.");
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            text: "Gagal mengambil nomor antrian",
                            icon: "error"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr, status, error);
                    Swal.fire({
                        title: "Terjadi Kesalahan",
                        text: "Coba lagi nanti",
                        icon: "error"
                    });
                }
            });
        });
    });
</script>
