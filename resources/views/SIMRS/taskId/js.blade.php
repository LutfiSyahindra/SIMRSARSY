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
                            d.start = range.startDate.format('YYYY-MM-DD');
                            d.end = range.endDate.format('YYYY-MM-DD');
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
                            d.start = range.startDate.format('YYYY-MM-DD');
                            d.end = range.endDate.format('YYYY-MM-DD');
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
                            d.start = range.startDate.format('YYYY-MM-DD');
                            d.end = range.endDate.format('YYYY-MM-DD');
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
                            d.start = range.startDate.format('YYYY-MM-DD');
                            d.end = range.endDate.format('YYYY-MM-DD');
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
