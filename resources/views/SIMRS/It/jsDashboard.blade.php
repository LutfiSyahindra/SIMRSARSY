<script>
    function formatSecondsToHoursMinutes(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        return `${hours} jam ${minutes} menit`;
    }

    function fetchWidgetData(startDate, endDate) {
        const query = `?start=${startDate}&end=${endDate}`;

        fetch(`/simrs/khususIt/widget/pengaduan${query}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('totalPengaduan').innerText = data.totalPengaduan;
                    document.getElementById('lastMonthPengaduan').innerText = data.lastMonthCount;

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


        fetch(`/simrs/khususIt/widget/restime${query}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const avgSeconds = Number(data.averageResponseTime) || 0;
                    const avgSecondsLast = Number(data.averageResponseTimeLast) || 0;

                    document.getElementById('avgResponseTime').innerText = formatSecondsToHoursMinutes(avgSeconds);
                    document.getElementById('avgLastMonth').innerText = formatSecondsToHoursMinutes(avgSecondsLast);

                    const badge = document.getElementById('avgResponseBadge');
                    const icon = document.getElementById('avgResponseIcon');
                    const percent = document.getElementById('avgResponsePercent');

                    if (data.growthType === 'up') {
                        badge.className = 'badge bg-danger me-1';
                        icon.className = 'ri-arrow-up-line';
                    } else {
                        badge.className = 'badge bg-success me-1';
                        icon.className = 'ri-arrow-down-line';
                    }

                    percent.innerText = data.growthPercent + '%';
                }
            });

        fetch(`/simrs/khususIt/widget/donetime${query}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const avgSeconds = Number(data.averageCompletionTime) || 0;
                    document.getElementById('avgCompletionTime').innerText = formatSecondsToHoursMinutes(
                        avgSeconds);

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

                    percent.innerText = data.growthPercent + '%';
                    lastMonth.innerText = formatSecondsToHoursMinutes(Number(data.averageCompletionTimeLast) || 0);
                }
            });
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

        // Fetch awal saat halaman dimuat
        const start = moment().startOf('month').format('YYYY-MM-DD');
        const end = moment().endOf('month').format('YYYY-MM-DD');
        fetchWidgetData(start, end);
    });
</script>
