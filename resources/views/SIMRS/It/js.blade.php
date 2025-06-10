<script>
    $(document).ready(function() {

        // CSRF TOKEN
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Table Users
        let laporanTable = $('#fixed-header-datatable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route("khususIt.laporan.table") }}", // Sesuaikan dengan route Anda
                type: "GET"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'waktu_laporan',
                    name: 'waktu_laporan'
                },
                {
                    data: 'tanggap_laporan',
                    name: 'tanggap_laporan'
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'ruangan',
                    name: 'ruangan'
                },
                {
                    data: 'analisa',
                    name: 'analisa'
                },
                {
                    data: 'tindak_lanjut',
                    name: 'tindak_lanjut'
                },
                {
                    data: 'waktu_penyelesaian',
                    name: 'waktu_penyelesaian'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#laporanForm').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();
            let laporanId = $('#laporanId').val(); // Ambil ID user jika ada
            let url = laporanId ? `/simrs/khususIt/laporan/${laporanId}/update` :
                "{{ route("khususIt.laporan.store") }}";
            let method = laporanId ? 'POST' : 'POST'; // Gunakan POST dan _method=PUT untuk update

            if (laporanId) {
                formData += '&_method=PUT'; // Laravel membutuhkan _method=PUT

                // ✅ Jika UPDATE, munculkan SweetAlert
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data ini akan diperbarui!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, update!",
                    cancelButtonText: "Batal",
                    reverseButtons: true,
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitForm(url, method, formData); // Panggil fungsi untuk update
                    } else {
                        Swal.fire({
                            title: "Dibatalkan",
                            text: "Data tidak diubah!",
                            icon: "error"
                        });
                    }
                });
            } else {
                // ✅ Jika CREATE, langsung kirim tanpa konfirmasi
                submitForm(url, method, formData);
            }
        });

        // ✅ Fungsi untuk submit form via AJAX
        function submitForm(url, method, formData) {
            $.ajax({
                url: url,
                method: method,
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        // $('#info-header-modal').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });

                        $('#laporanForm')[0].reset();
                        $('#laporanId').val(''); // Reset ID
                        laporanTable.ajax.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();

                        let errors = xhr.responseJSON.errors;
                        for (let key in errors) {
                            let inputField = $(`#${key}`);
                            inputField.addClass('is-invalid');
                            inputField.after(
                                `<div class="invalid-feedback">${errors[key][0]}</div>`);
                        }
                    }
                }
            });
        }

        window.editLaporan = function(id) {
            console.log('Edit Laporan ID:', id);

            $.ajax({
                url: `/simrs/khususIt/laporan/${id}/edit`,
                type: 'GET',
                success: function(response) {
                    console.log(response);

                    if (response.status === 'success') {
                        const data = response.data;

                        $('#laporanId').val(data.id);
                        $('#tanggal').val(data.tanggal);
                        $('#waktu_laporan').val(data.waktu_laporan);
                        $('#tanggap_laporan').val(data.tanggap_laporan);
                        $('#nama_barang').val(data.nama_barang);
                        $('#ruangan').val(data.ruangan);
                        $('#analisa').val(data.analisa);
                        $('#tindak_lanjut').val(data.tindak_lanjut);
                        $('#waktu_penyelesaian').val(data.waktu_penyelesaian);

                        // Buka accordion pakai Bootstrap Collapse
                        const accordion = document.getElementById('collapseForm');
                        const bsCollapse = new bootstrap.Collapse(accordion, {
                            toggle: false
                        });
                        bsCollapse.show();

                        // Fokus ke input nama barang
                        $('#nama_barang').focus();
                    } else {
                        Swal.fire('Gagal', 'Data tidak ditemukan', 'error');
                    }
                },
                error: function(xhr) {
                    console.error('Gagal ambil data:', xhr);
                    Swal.fire('Gagal', 'Data tidak ditemukan', 'error');
                }
            });
        };

        window.deleteLaporan = function(id) {
            // Tampilkan konfirmasi hapus
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Laporan ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim request DELETE menggunakan AJAX
                    $.ajax({
                        url: "{{ route("khususIt.laporan.delete", ":id") }}".replace(':id',
                            id),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Dihapus!',
                                    response.message,
                                    'success'
                                );
                                laporanTable.ajax.reload(); // Reload DataTables
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus role.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

    });
</script>
