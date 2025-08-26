<script>
    function fetchWidgetData(startDate, endDate) {
        const query = `?start=${startDate}&end=${endDate}`;
        window.detailTaskidOnsite = function() {
            $('#info-header-modal').modal('show');

            // Inisialisasi DataTable untuk tab Terkirim
            if ($.fn.DataTable.isDataTable('#TaskIdOnsiteTerkirimTable')) {
                $('#TaskIdOnsiteTerkirimTable').DataTable().ajax.reload();
            } else {
                $('#TaskIdOnsiteTerkirimTable').DataTable({
                    ajax: {
                        url: '/simrs/taskId/taskIdOnsite',
                        data: function(d) {
                            const range = $('#taskIdDateRange').data('daterangepicker');
                            d.start_date = range.startDate.format('YYYY-MM-DD');
                            d.end_date = range.endDate.format('YYYY-MM-DD');
                            d.status = 'terkirim';
                        }
                    },
                    processing: true,
                    serverSide: true,
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
                            data: 'nm_pasien',
                            name: 'nm_pasien'
                        },
                        {
                            data: 'nm_poli',
                            name: 'nm_poli'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data, type, row) {
                                if (data === 'Success') {
                                    return '<a href="#" class="status-badge text-decoration-none" data-no_rawat="' +
                                        row.no_rawat + '" data-status="' + data + '">' +
                                        '<span class="badge bg-success"><i class="bi bi-check-circle"></i> ' +
                                        data + '</span>' +
                                        '</a>';
                                } else if (data === 'Warning') {
                                    return '<a href="#" class="status-badge text-decoration-none" data-no_rawat="' +
                                        row.no_rawat + '" data-status="' + data + '">' +
                                        '<span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle"></i> ' +
                                        data + '</span>' +
                                        '</a>';
                                } else {
                                    return data;
                                }
                            }
                        }, {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            }

            // Inisialisasi DataTable untuk tab Terkirim
            if ($.fn.DataTable.isDataTable('#TaskIdOnsiteBelumTable')) {
                $('#TaskIdOnsiteBelumTable').DataTable().ajax.reload();
            } else {
                $('#TaskIdOnsiteBelumTable').DataTable({
                    ajax: {
                        url: '/simrs/taskId/taskIdOnsite',
                        data: function(d) {
                            const range = $('#taskIdDateRange').data('daterangepicker');
                            d.start_date = range.startDate.format('YYYY-MM-DD');
                            d.end_date = range.endDate.format('YYYY-MM-DD');
                            d.status = 'belum';
                        }
                    },
                    processing: true,
                    serverSide: true,
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
                            data: 'nm_pasien',
                            name: 'nm_pasien'
                        },
                        {
                            data: 'nm_poli',
                            name: 'nm_poli'
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            }
        }
        window.detailTaskidMjkn = function() {
            $('#TaskIdMjknModal').modal('show');

            // Inisialisasi DataTable untuk tab Terkirim
            if ($.fn.DataTable.isDataTable('#TaskIdMjknTerkirimTable')) {
                $('#TaskIdMjknTerkirimTable').DataTable().ajax.reload();
            } else {
                $('#TaskIdMjknTerkirimTable').DataTable({
                    ajax: {
                        url: '/simrs/taskId/taskIdMjkn',
                        data: function(d) {
                            const range = $('#taskIdDateRange').data('daterangepicker');
                            d.start_date = range.startDate.format('YYYY-MM-DD');
                            d.end_date = range.endDate.format('YYYY-MM-DD');
                            d.status = 'terkirim';
                        }
                    },
                    processing: true,
                    serverSide: true,
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
                            data: 'nm_pasien',
                            name: 'nm_pasien'
                        },
                        {
                            data: 'nm_poli',
                            name: 'nm_poli'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data, type, row) {
                                if (data === 'Success') {
                                    return '<a href="#" class="status-badge text-decoration-none" data-no_rawat="' +
                                        row.no_rawat + '" data-status="' + data + '">' +
                                        '<span class="badge bg-success"><i class="bi bi-check-circle"></i> ' +
                                        data + '</span>' +
                                        '</a>';
                                } else if (data === 'Warning') {
                                    return '<a href="#" class="status-badge text-decoration-none" data-no_rawat="' +
                                        row.no_rawat + '" data-status="' + data + '">' +
                                        '<span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle"></i> ' +
                                        data + '</span>' +
                                        '</a>';
                                } else {
                                    return data;
                                }
                            }
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            }

            // Inisialisasi DataTable untuk tab Terkirim
            if ($.fn.DataTable.isDataTable('#TaskIdBelumMjknTable')) {
                $('#TaskIdBelumMjknTable').DataTable().ajax.reload();
            } else {
                $('#TaskIdBelumMjknTable').DataTable({
                    ajax: {
                        url: '/simrs/taskId/taskIdMjkn',
                        data: function(d) {
                            const range = $('#taskIdDateRange').data('daterangepicker');
                            d.start_date = range.startDate.format('YYYY-MM-DD');
                            d.end_date = range.endDate.format('YYYY-MM-DD');
                            d.status = 'belum';
                        }
                    },
                    processing: true,
                    serverSide: true,
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
                            data: 'nm_pasien',
                            name: 'nm_pasien'
                        },
                        {
                            data: 'nm_poli',
                            name: 'nm_poli'
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            }
        }

        fetch(`/simrs/taskId/getTaskId${query}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === 'success') {

                    document.getElementById('totalTerkirim').innerText = data.count;
                    document.getElementById('belumTerkirim').innerText = data.belumTerkirim;
                    document.getElementById('Jkn').innerText = data.JKNcount;
                    document.getElementById('jknBelum').innerText = data.JKNbelumTerkirim;
                    document.getElementById('totalRataLayanan').innerText = data.totalRata;
                }
            });

        fetch(`/simrs/taskId/rataAdmisi${query}`)
            .then(response => response.json())
            .then(data => {
                console.log('admisi', data);
                if (data.status === 'success') {
                    document.getElementById('totalAdmisi').innerText = data.totalRataAdmisi;
                    document.getElementById('totalLayananAdmisi').innerText = data.totalRataLayananAdmisi;
                }
            });

        fetch(`/simrs/taskId/rataPoli${query}`)
            .then(response => response.json())
            .then(data => {
                console.log('poli', data);
                if (data.status === 'success') {
                    document.getElementById('tungguPoli').innerText = data.totalRataTungguPoli;
                    document.getElementById('layananPoli').innerText = data.totalRataLayananPoli;
                }
            });
        fetch(`/simrs/taskId/rataFarmasi${query}`)
            .then(response => response.json())
            .then(data => {
                console.log('farmasi', data);
                if (data.status === 'success') {
                    document.getElementById('tungguFarmasi').innerText = data.totalRataTungguFarmasi;
                    document.getElementById('layananFarmasi').innerText = data.totalRataLayananFarmasi;
                }
            });
    }

    window.detailOnsite = function(id) {
        console.log('id', id);
        const modal = $('#log-taskid-modal');
        modal.modal('show');

        let usersTable = $('#TaskIdLogTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route("taskId.detailTaskid") }}", // Sesuaikan dengan route Anda
                type: "GET",
                data: {
                    no_rawat: id
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
    }

    $(document).on('click', '.status-badge', function(e) {
        e.preventDefault();

        let noRawat = $(this).data('no_rawat');
        let status = $(this).data('status');

        if (status === 'Warning') {
            const modal = $('#LogModal');
            modal.modal('show');

            // hancurkan instance lama agar tidak double
            if ($.fn.DataTable.isDataTable('#LogTable')) {
                $('#LogTable').DataTable().destroy();
            }

            // inisialisasi ulang DataTables
            $('#LogTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/simrs/taskId/logTaskId',
                    data: function(d) {
                        d.no_rawat = noRawat;
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
                        data: 'task_id',
                        name: 'task_id'
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
                    }
                ]
            });

        } else {
            const modal = $('#LogModal');
            modal.modal('show');

            // hancurkan instance lama agar tidak double
            if ($.fn.DataTable.isDataTable('#LogTable')) {
                $('#LogTable').DataTable().destroy();
            }

            // inisialisasi ulang DataTables
            $('#LogTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/simrs/taskId/logTaskId',
                    data: function(d) {
                        d.no_rawat = noRawat;
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
                        data: 'task_id',
                        name: 'task_id'
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
                    }
                ]
            });
        }
    });



    document.addEventListener('DOMContentLoaded', function() {
        $('#taskIdDateRange').daterangepicker({
            startDate: moment(),
            endDate: moment(),
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end) {
            fetchWidgetData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        });

        // Fetch awal saat halaman dimuat
        const start = moment().format('YYYY-MM-DD');
        const end = moment().format('YYYY-MM-DD');
        fetchWidgetData(start, end);
    });
</script>
