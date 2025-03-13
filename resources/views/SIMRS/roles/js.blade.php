<script>
    $(document).ready(function() {

        // CSRF TOKEN
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Table Users
        let rolesTable = $('#fixed-header-datatable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route("roles.table") }}", // Sesuaikan dengan route Anda
                type: "GET"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Modal Add Users (Hide) 
        $('#info-header-modal').on('hidden.bs.modal', function() {
            console.log('Modal ditutup, reset form.');
            $('#rolesForm')[0].reset();
            $('#info-header-modalLabel').text('ADD ROLES');
            $('#submitRoles').text('Submit'); // Atau $('#submitUsers').html('Update');
        });

        $('#rolesForm').submit(function(e) {
            e.preventDefault(); // Mencegah form submit secara default

            let formData = $(this).serialize(); // Ambil data form

            $.ajax({
                url: '{{ route("roles.store") }}', // Ganti dengan URL endpoint penyimpanan di Laravel
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        });

                        $('#info-header-modal').modal('hide'); // Tutup modal
                        $('#rolesForm')[0].reset(); // Reset form
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan, coba lagi.'
                    });
                }
            });
        });

        window.editRoles = function(id) {
            const modal = $('#info-header-modal');
            modal.modal('show');

            $('#rolesForm')[0].reset();
            $('#roleId').val(id); // Set ID user
            console.log('id', id);

            $.ajax({
                url: `/simrs/roles/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    console.log('dataRoles :', response);
                    $('#info-header-modalLabel').text('EDIT ROLES'); // Ubah judul
                    $('#submitRoles').text('Update'); // Atau $('#submitUsers').html('Update');
                    $('#name').val(response.name);
                },
                error: function(xhr) {
                    console.error('Gagal mengambil data user', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to fetch user data. Please try again.',
                    });
                    modal.modal('hide');
                }
            });
        };

    });
</script>
