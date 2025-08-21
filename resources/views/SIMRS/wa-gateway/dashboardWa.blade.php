@extends("template.partials._app")

@section("styles")
    @include("template.plugins.dataTables")
    @include("template.plugins.select2")
@endsection

@section("content")
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">
                <h4 class="page-title">Dashboard WA GATEWAY</h4>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <label class="form-label mb-0">
                        <i class="bi bi-calendar-event" style="font-size: 1.2rem;"></i>
                    </label>
                    <input type="text" id="dashboardDateRange" class="form-control" style="max-width: 250px;" readonly>
                </div>

            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-xxl-6 row-cols-lg-3 row-cols-md-2">
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">WA Terkirim</h5>
                            <h3 class="my-3" id="totalTerkirim">0</h3> <!-- jumlah pengaduan bulan ini -->

                            <p class="mb-0 text-muted text-truncate d-flex align-items-center gap-1">
                                <span id="growthBadge" class="badge bg-success me-1 d-flex align-items-center">
                                    <i id="growthIcon" class="ri-arrow-up-line me-1"></i>
                                    <span id="growthValue">0</span>
                                </span>
                                <span id="lastMonthBadge" class="badge bg-secondary">
                                    Bulan Lalu: <span id="lastMonthTerkirim">0</span>
                                </span>
                            </p>

                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-group-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0" title="Average Response Time">
                                WA Terjadwal
                            </h5>
                            <h3 class="my-3" id="waTerjadwal">0</h3>
                            <div class="d-flex align-items-center gap-1 flex-wrap">
                                <span id="avgResponseBadge" class="badge bg-success">
                                    <i id="avgResponseIcon" class="ri-arrow-up-line"></i>
                                    <span id="avgResponsePercent">0%</span>
                                </span>
                                <span class="badge bg-secondary" id="avgLastMonthBadge">
                                    Bulan Lalu: <span id="avgLastMonth">0</span>
                                </span>
                                {{-- <span class="text-muted small">last month</span> --}}
                            </div>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-shopping-basket-2-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">WA Gagal</h5>
                            <h3 class="my-3" id="waGagal">0</h3>
                            <div class="d-flex align-items-center gap-1 flex-wrap">
                                <span id="avgCompletionBadge" class="badge bg-success">
                                    <i id="avgCompletionIcon" class="ri-arrow-up-line"></i>
                                    <span id="avgCompletionPercent">0%</span>
                                </span>
                                <span class="badge bg-secondary">
                                    Bulan Lalu: <span id="avgCompletionLastMonth">0</span>
                                </span>
                                {{-- <span class="text-muted small">last month</span> --}}
                            </div>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-warning rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-time-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">WA Belum</h5>
                            <h3 class="my-3" id="totalBelum">0</h3> <!-- jumlah pengaduan bulan ini -->

                            <p class="mb-0 text-muted text-truncate d-flex align-items-center gap-1">
                                <span id="growthBadgeBelum" class="badge bg-success me-1 d-flex align-items-center">
                                    <i id="growthIconBelum" class="ri-arrow-up-line me-1"></i>
                                    <span id="growthValueBelum">0</span>%
                                </span>
                                <span id="lastMonthBadgeBelum" class="badge bg-secondary">
                                    Bulan Lalu: <span id="lastMonthBelum">0</span>
                                </span>
                            </p>

                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-group-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">WA Batal</h5>
                            <h3 class="my-3" id="totalBatal">0</h3> <!-- jumlah pengaduan bulan ini -->

                            <p class="mb-0 text-muted text-truncate d-flex align-items-center gap-1">
                                <span id="growthBadgeBatal" class="badge bg-success me-1 d-flex align-items-center">
                                    <i id="growthIconBatal" class="ri-arrow-up-line me-1"></i>
                                    <span id="growthValueBatal">0</span>%
                                </span>
                                <span id="lastMonthBadgeBatal" class="badge bg-secondary">
                                    Bulan Lalu: <span id="lastMonthBatal">0</span>
                                </span>
                            </p>

                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span
                                class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-group-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card text-center shadow-sm hover-shadow border-0">
                <div class="card-body">
                    <i class="ri-file-list-3-line fs-2 text-primary mb-2"></i>
                    <h5 class="card-title mb-1">Daftar Wa</h5>
                    <p class="text-muted mb-2">Lihat Data Wa</p>
                    <a href="/simrs/waGetway/LaporanWa" class="btn btn-sm btn-outline-primary">Lihat</a>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="card text-center shadow-sm hover-shadow border-0">
                <div class="card-body">
                    <i class="ri-time-line fs-2 text-warning mb-2"></i>
                    <h5 class="card-title mb-1">Log WA GAteway</h5>
                    <p class="text-muted mb-2">Lihat Data Log Wa Gateway</p>
                    <a href="#" class="btn btn-sm btn-outline-warning">Lihat</a>
                </div>
            </div>
        </div> --}}
    </div>

@endsection

@section("scripts")
    @include("SIMRS.wa-gateway.jsDashboarWa")
    {{-- <script src="{{ asset("dist/assets/js/pages/demo.dashboard.js") }}"></script> --}}
    <script src="{{ asset("dist/assets/vendor/apexcharts/apexcharts.min.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@append
