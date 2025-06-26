@extends("template.partials._app")

@section("styles")
    @include("template.plugins.dataTables")
    @include("template.plugins.select2")
    <style>
        table.dataTable thead input.filter-col {
            padding: 6px 10px;
            font-size: 13px;
            height: auto;
        }
    </style>
@endsection

@section("content")
    @include("SIMRS.wa-gateway.modallog")
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Laporan Wa</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Laporan</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">WA</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2 mt-2">
        <label class="form-label mb-0">
            <i class="bi bi-calendar-event" style="font-size: 1.2rem;"></i>
        </label>
        <input type="text" id="dashboardDateRange" class="form-control" style="max-width: 250px;" readonly>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <br>
                    <h4 class="header-title">Data WA</h4>
                    <!-- Tambahkan table-responsive agar tabel bisa di-scroll jika lebarnya lebih besar dari layar -->
                    <div class="table-responsive">
                        <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Rawat</th>
                                    <th>No RM</th>
                                    <th>Nama</th>
                                    <th>Tgl Wa</th>
                                    <th>No Wa</th>
                                    <th>Wa Status</th>
                                    <th>Status Pesan</th>
                                    <th>Actions</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th><input type="text" class="form-control form-control-sm w-100 filter-col"
                                            placeholder="Cari No Rawat"></th>
                                    <th><input type="text" class="form-control form-control-sm w-100 filter-col"
                                            placeholder="Cari No RM"></th>
                                    <th><input type="text" class="form-control form-control-sm w-100 filter-col"
                                            placeholder="Cari Nama"></th>
                                    <th><input type="text" class="form-control form-control-sm w-100 filter-col"
                                            placeholder="Cari Tgl WA"></th>
                                    <th><input type="text" class="form-control form-control-sm w-100 filter-col"
                                            placeholder="Cari No WA"></th>
                                    <th> <select class="form-select form-select-sm w-100 filter-col" id="filterWaStatus">
                                            <option value="">Semua</option>
                                            <option value="registrasi">Registrasi</option>
                                            <option value="kontrol">Kontrol</option>
                                            <option value="Reminder kontrol">Reminder kontrol</option>
                                            <option value="hari kontrol">Hari kontrol</option>
                                            <option value="FU Kondisi">FU Kondisi</option>
                                            <!-- Tambahkan opsi lain sesuai kebutuhan -->
                                        </select></th>
                                    <th>
                                        <select class="form-select form-select-sm w-100 filter-col" id="filterStatusPesan">
                                            <option value="">Semua</option>
                                            <option value="terkirim">Terkirim</option>
                                            <option value="belum">Belum</option>
                                            <option value="gagal">Gagal</option>
                                            <option value="terjadwal">Terjadwal</option>
                                            <!-- Tambahkan jika ada status lain -->
                                        </select>
                                    </th>
                                    <th></th>
                                </tr>

                            </thead>
                        </table>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->
@endsection

@section("scripts")
    @include("SIMRS.wa-gateway.jsLaporanWa")
@append
