<script>
    let dataTableInstance;

    $(document).ready(function() {
        // Inisialisasi date range picker
        const today = moment();
        const start = today.clone().startOf('month');
        const end = today.clone().endOf('month');

        function cb(start, end) {
            $('#dashboardDateRange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            fetchWidgetData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        }

        $('#dashboardDateRange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Hari Ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        window.detailLog = function(id) {
            console.log('Detail log ' + id);
            const modal = $('#info-header-modal');
            const tableBody = modal.find('#logWaTable tbody');

            // Kosongkan dan tampilkan pesan loading
            tableBody.html('<tr><td colspan="3" class="text-center">Memuat data...</td></tr>');
            modal.modal('show');

            // Ambil data dari server
            $.ajax({
                url: `/simrs/waGetway/log/${id}`, // Ganti sesuai route-mu
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    if (response.data.length > 0) {
                        let rows = '';
                        response.data.forEach(log => {
                            rows += `
                        <tr>
                            <td>${log.waktu_log}</td>
                            <td>${log.pesan}</td>
                            <td>${log.status_log}</td>
                        </tr>
                    `;
                        });
                        tableBody.html(rows);
                    } else {
                        tableBody.html(
                            '<tr><td colspan="3" class="text-center">Tidak ada data log</td></tr>'
                        );
                    }
                },
                error: function() {
                    tableBody.html(
                        '<tr><td colspan="3" class="text-danger text-center">Gagal mengambil data log</td></tr>'
                    );
                }
            });
        };

    });

    function fetchWidgetData(startDate, endDate) {
        const query = `?start_date=${startDate}&end_date=${endDate}`;

        if (dataTableInstance) {
            dataTableInstance.ajax.url(`/simrs/waGetway/tabledata${query}`).load();
            return;
        }

        dataTableInstance = $('#fixed-header-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `/simrs/waGetway/tabledata${query}`,
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'no_rawat',
                    name: 'no_rawat'
                },
                {
                    data: 'no_rm',
                    name: 'no_rm'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'tgl_wa',
                    name: 'tgl_wa'
                },
                {
                    data: 'no_telp',
                    name: 'no_telp'
                },
                {
                    data: 'wa_status',
                    name: 'wa_status'
                },
                {
                    data: 'status_send',
                    name: 'status_send'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            responsive: true,
            destroy: true // Bolehkan destroy agar bisa di-reinitialize dengan aman
        });
        // 👇 Aktifkan filter kolom setelah DataTable diinisialisasi
        $('#fixed-header-datatable thead').on('keyup change', '.filter-col', function() {
            let colIndex = $(this).closest('th').index();
            dataTableInstance
                .column(colIndex)
                .search(this.value)
                .draw();
        });
    }
</script>
