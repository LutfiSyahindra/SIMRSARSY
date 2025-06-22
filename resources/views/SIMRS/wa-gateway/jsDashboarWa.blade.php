<script>
    let dataTableInstance;

    function formatSecondsToHoursMinutes(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        return `${hours} jam ${minutes} menit`;
    }

    function fetchWidgetData(startDate, endDate) {
        const query = `?start=${startDate}&end=${endDate}`;

        fetch(`/simrs/waGetway/terkirim${query}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('totalTerkirim').innerText = data.totalTerkirim;
                    document.getElementById('lastMonthTerkirim').innerText = data.lastMonthCount;

                    const growthBadge = document.getElementById('growthBadge');
                    const growthIcon = document.getElementById('growthIcon');
                    const growthValue = document.getElementById('growthValue');
                    const isGrowthUp = data.growthType === 'up';

                    growthBadge.className =
                        `badge ${isGrowthUp ? 'bg-success' : 'bg-danger'} me-1 d-flex align-items-center`;
                    growthIcon.className = `ri-arrow-${isGrowthUp ? 'up' : 'down'}-line me-1`;
                    growthValue.innerText = data.growth + '%';
                }
            });


        fetch(`/simrs/waGetway/terjadwal${query}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {

                    document.getElementById('waTerjadwal').innerText = data.totalTerjadwal;
                    document.getElementById('avgLastMonth').innerText = data.lastMonthCount;

                    const badge = document.getElementById('avgResponseBadge');
                    const icon = document.getElementById('avgResponseIcon');
                    const percent = document.getElementById('avgResponsePercent');

                    if (data.growthType === 'up') {
                        badge.className = 'badge bg-success me-1';
                        icon.className = 'ri-arrow-up-line';
                    } else {
                        badge.className = 'badge bg-danger me-1';
                        icon.className = 'ri-arrow-down-line';
                    }

                    percent.innerText = data.growth + '%';
                }
            });

        fetch(`/simrs/waGetway/gagal${query}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('waGagal').innerText = data.totalGagal;
                    document.getElementById('avgCompletionLastMonth').innerText = data.lastMonthCount;

                    const badge = document.getElementById('avgCompletionBadge');
                    const icon = document.getElementById('avgCompletionIcon');
                    const percent = document.getElementById('avgCompletionPercent');
                    const lastMonth = document.getElementById('avgCompletionLastMonth');

                    if (data.growthType === 'up') {
                        badge.className = 'badge bg-danger me-1';
                        icon.className = 'ri-arrow-up-line';
                    } else {
                        badge.className = 'badge bg-success me-1';
                        icon.className = 'ri-arrow-down-line';
                    }

                    percent.innerText = data.growth + '%';

                }
            });

        fetch(`/simrs/waGetway/belum${query}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('totalBelum').innerText = data.totalBelum;
                    document.getElementById('lastMonthBelum').innerText = data.lastMonthCount;

                    const growthBadgeBelum = document.getElementById('growthBadgeBelum');
                    const growthIconBelum = document.getElementById('growthIconBelum');
                    const growthValueBelum = document.getElementById('growthValueBelum');
                    const isGrowthUp = data.growthType === 'up';

                    growthBadgeBelum.className =
                        `badge ${isGrowthUp ? 'bg-success' : 'bg-danger'} me-1 d-flex align-items-center`;
                    growthIconBelum.className = `ri-arrow-${isGrowthUp ? 'up' : 'down'}-line me-1`;
                    growthValueBelum.innerText = data.growth + '%';
                }
            });

        fetch(`/simrs/waGetway/batal${query}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('totalBatal').innerText = data.totalBatal;
                    document.getElementById('lastMonthBatal').innerText = data.lastMonthCount;

                    const growthBadgeBatal = document.getElementById('growthBadgeBatal');
                    const growthIconBatal = document.getElementById('growthIconBatal');
                    const growthValueBatal = document.getElementById('growthValueBatal');
                    const isGrowthUp = data.growthType === 'up';

                    growthBadgeBatal.className =
                        `badge ${isGrowthUp ? 'bg-success' : 'bg-danger'} me-1 d-flex align-items-center`;
                    growthIconBatal.className = `ri-arrow-${isGrowthUp ? 'up' : 'down'}-line me-1`;
                    growthValueBatal.innerText = data.growth + '%';
                }
            });

        // Update data tabel
        if (dataTableInstance) {
            const newUrl = `/simrs/waGetway/tabledata${query}`;
            dataTableInstance.ajax.url(newUrl).load();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        $('#dashboardDateRange').daterangepicker({
            startDate: moment().startOf('month'),
            endDate: moment().endOf('month'),
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end) {
            fetchWidgetData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        });

        // 🛠 Destroy DataTable jika sudah ada sebelumnya
        if ($.fn.DataTable.isDataTable('#fixed-header-datatable')) {
            console.log('Destroying existing DataTable...');
            $('#fixed-header-datatable').DataTable().clear().destroy();
        }

        // ✅ Inisialisasi ulang DataTable
        console.log('Initializing DataTable...');
        dataTableInstance = $('#fixed-header-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/simrs/waGetway/tabledata',
                data: function(d) {
                    const range = $('#dashboardDateRange').data('daterangepicker');
                    d.start = range.startDate.format('YYYY-MM-DD');
                    d.end = range.endDate.format('YYYY-MM-DD');
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
            ]
        });

        // Fetch awal saat halaman dimuat
        const start = moment().startOf('month').format('YYYY-MM-DD');
        const end = moment().endOf('month').format('YYYY-MM-DD');
        fetchWidgetData(start, end);
    });
</script>
