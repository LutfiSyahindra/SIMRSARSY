<script>
    let dataTableInstance;

    function fetchWidgetData(startDate, endDate) {
        const query = `?start_date=${startDate}&end_date=${endDate}`;

        if (dataTableInstance) {
            dataTableInstance.ajax.url(`/simrs/taskId/dataTaskId${query}`).load();
            return;
        }

        dataTableInstance = $('#fixed-header-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `/simrs/taskId/dataTaskId${query}`,
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'no_rawat',
                    name: 'no_rawat'
                },
                {
                    data: 'nm_poli',
                    name: 'nm_poli'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data) {
                        if (data === 'MJKN') {
                            return `<span class="badge bg-success">${data}</span>`;
                        } else if (data) {
                            return `<span class="badge bg-warning text-dark">${data}</span>`;
                        } else {
                            return `<span class="badge bg-danger">-</span>`;
                        }
                    }
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            responsive: true,
            destroy: true,
            initComplete: function() {
                // Aktifkan filter kolom setelah DataTable siap
                $('#fixed-header-datatable thead').on('keyup change', '.filter-col', function() {
                    let colIndex = $(this).closest('th').index();
                    dataTableInstance
                        .column(colIndex)
                        .search(this.value)
                        .draw();
                });
            }
        });
    }


    // 👇 Fungsi untuk menampilkan detail user
    window.detailTaskid = function(no_rawat) {
        const modal = $('#info-header-modal');
        modal.modal('show');

        let usersTable = $('#TaskIdLogTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route("taskId.detailTaskid") }}", // Sesuaikan dengan route Anda
                type: "GET",
                data: {
                    no_rawat: no_rawat
                }
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
                    data: 'taskid',
                    name: 'taskid'
                },
                {
                    data: 'waktu',
                    name: 'waktu'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        if (data == 200) {
                            return `<span class="badge bg-success">200</span>`;
                        } else {
                            return `<span class="badge bg-danger">${data ?? '-'}</span>`;
                        }
                    }
                },
                {
                    data: 'log',
                    name: 'log'
                },
            ],
            footerCallback: function(row, data, start, end, display) {
                let api = this.api();

                // Ambil total waktu dari response tambahan
                let json = api.ajax.json();
                if (json && json.total_waktu) {
                    // tampilkan
                    $('#totalWaktu').html(json.total_waktu);

                    // cek apakah < 3 jam
                    let parts = json.total_waktu.split(':'); // [HH, MM, SS]
                    let jam = parseInt(parts[0], 10);

                    if (jam < 3) {
                        $('#totalWaktu').css('color', 'green');
                    } else {
                        $('#totalWaktu').css('color', 'red');
                    }
                } else {
                    $('#totalWaktu').html("-").css('color', '');
                }
            }

        });
    };

    $(document).ready(function() {
        // Inisialisasi date range picker
        const today = moment();
        const start = today.clone().startOf('month');
        const end = today.clone().endOf('month');

        function cb(start, end) {
            $('#taskIdListDateRange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            fetchWidgetData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        }

        $('#taskIdListDateRange').daterangepicker({
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

    });
</script>
