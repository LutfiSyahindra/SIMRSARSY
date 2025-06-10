@extends("template.partials._app")

@section("styles")
    @include("template.plugins.dataTables")
    @include("template.plugins.select2")
@endsection

@section("content")
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Pengaduan</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Laporan</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pengaduan</a></li>
                </ol>
            </div>
        </div>
    </div>

    <div class="accordion mb-4" id="accordionLaporanForm">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingForm">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">
                    Tambah Pengaduan
                </button>
            </h2>
            <div id="collapseForm" class="accordion-collapse collapse" aria-labelledby="headingForm"
                data-bs-parent="#accordionLaporanForm">
                <div class="accordion-body">
                    <form id="laporanForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                            </div>
                            <div class="col-md-4">
                                <label for="waktu_laporan" class="form-label">Waktu Laporan</label>
                                <input type="time" class="form-control" name="waktu_laporan" id="waktu_laporan" required>
                            </div>
                            <div class="col-md-4">
                                <label for="tanggap_laporan" class="form-label">Tanggap Laporan</label>
                                <input type="time" class="form-control" name="tanggap_laporan" id="tanggap_laporan">
                            </div>
                            <div class="col-md-6">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ruangan" class="form-label">Ruangan</label>
                                <input type="text" class="form-control" name="ruangan" id="ruangan" required>
                            </div>
                            <div class="col-md-6">
                                <label for="analisa" class="form-label">Analisa</label>
                                <textarea class="form-control" name="analisa" id="analisa" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
                                <textarea class="form-control" name="tindak_lanjut" id="tindak_lanjut" rows="2"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="waktu_penyelesaian" class="form-label">Waktu Penyelesaian</label>
                                <input type="time" class="form-control" name="waktu_penyelesaian"
                                    id="waktu_penyelesaian">
                            </div>
                            <input id="laporanId" class="form-control" name="laporanId" type="hidden">
                            <div class="col-12">
                                <button type="submit" id="submitLaporan" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <br>
                    <h4 class="header-title">Data Pengaduan</h4>
                    <!-- Tambahkan table-responsive agar tabel bisa di-scroll jika lebarnya lebih besar dari layar -->
                    <div class="table-responsive">
                        <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Laporan</th>
                                    <th>Tanggap Laporan</th>
                                    <th>Nama Barang</th>
                                    <th>Ruangan</th>
                                    <th>Analisa</th>
                                    <th>Tindak Lanjut</th>
                                    <th>Waktu Penyelesaian</th>
                                    <th>Actions</th>
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
    @include("SIMRS.It.js")
@append
