@extends("template.partials._app")

@section("styles")
    @include("template.plugins.dataTables")
    @include("template.plugins.select2")
@endsection

@section("content")
    @include("SIMRS.taskId.modalOnsite")
    @include("SIMRS.taskId.modalMjkn")
    @include("SIMRS.taskId.modalDetail")
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">
                <h4 class="page-title">Dashboard Task ID</h4>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <label class="form-label mb-0">
                        <i class="bi bi-calendar-event" style="font-size: 1.2rem;"></i>
                    </label>
                    <input type="text" id="taskIdDateRange" class="form-control" style="max-width: 250px;" readonly>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between flex-grow-1">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">
                                Task Id Terkirim Pasien Onsite
                            </h5>
                            <h3 class="my-3" id="totalTerkirim">0</h3>
                            <p class="mb-0 text-muted text-truncate d-flex align-items-center gap-1">
                                <span id="lastMonthBadge" class="badge bg-secondary">
                                    Belum Terkirim: <span id="belumTerkirim">0</span>
                                </span>
                            </p>
                        </div>

                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-hospital-line"></i>
                            </span>
                        </div>
                    </div>

                    <!-- ✅ Tombol di pojok kanan bawah -->
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-sm btn-primary" onclick="detailTaskidOnsite()">
                            <i class="ri-search-line me-1"></i> Detail
                        </button>
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
                                Task Id Terkirim Pasien JKN
                            </h5>
                            <h3 class="my-3" id="Jkn">0</h3>
                            <div class="d-flex align-items-center gap-1 flex-wrap">
                                <span class="badge bg-secondary" id="avgLastMonthBadge">
                                    Belum Terkirim: <span id="jknBelum">0</span>
                                </span>
                            </div>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-contacts-book-line"></i>
                            </span>
                        </div>
                    </div>
                    <!-- ✅ Tombol di pojok kanan bawah -->
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-sm btn-success" onclick="detailTaskidMjkn()">
                            <i class="ri-search-line me-1"></i> Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card text-center shadow-sm hover-shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h3 class="text-muted text-uppercase mt-0">Rata-Rata Total Waktu Layanan</h3>
                            <h3 class="my-3" id="totalRataLayanan">0</h3> <!-- jumlah pengaduan bulan ini -->
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-warning rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-hospital-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-xxl-6 row-cols-lg-3 row-cols-md-2">
        <!-- Rata-Rata Waktu Tunggu Admisi -->
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">Rata-Rata Waktu Tunggu Admisi</h5>
                            <h3 class="my-3" id="totalAdmisi">0</h3>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-user-add-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rata-Rata Waktu Tunggu Poli -->
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">Rata-Rata Waktu Tunggu Poli</h5>
                            <h3 class="my-3" id="tungguPoli">0</h3>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-stethoscope-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rata-Rata Waktu Tunggu Farmasi -->
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">Rata-Rata Waktu Tunggu Farmasi</h5>
                            <h3 class="my-3" id="tungguFarmasi">0</h3>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-capsule-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rata-Rata Waktu Layanan Admisi -->
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">Rata-Rata Waktu Layanan Admisi</h5>
                            <h3 class="my-3" id="totalLayananAdmisi">0</h3>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span
                                class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-user-add-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rata-Rata Waktu Layanan Poli -->
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">Rata-Rata Waktu Layanan Poli</h5>
                            <h3 class="my-3" id="layananPoli">0</h3>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span
                                class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-stethoscope-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rata-Rata Waktu Layanan Farmasi -->
        <div class="col">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">Rata-Rata Waktu Layanan Farmasi</h5>
                            <h3 class="my-3" id="layananFarmasi">0</h3>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span
                                class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-capsule-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card text-center shadow-sm hover-shadow border-0">
                <div class="card-body">
                    <i class="ri-file-list-3-line fs-2 text-primary mb-2"></i>
                    <h5 class="card-title mb-1">List Task ID</h5>
                    <p class="text-muted mb-2">Lihat Data Task ID</p>
                    <a href="/simrs/taskId/table" class="btn btn-sm btn-outline-primary">Lihat</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
    @include("SIMRS.taskId.js")
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@append
