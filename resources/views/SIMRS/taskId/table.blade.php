@extends("template.partials._app")

@section("styles")
    @include("template.plugins.dataTables")
    @include("template.plugins.select2")
@endsection

@section("content")
    @include("SIMRS.taskId.modalDetail")
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Task Id</h4>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <label class="form-label mb-0">
                        <i class="bi bi-calendar-event" style="font-size: 1.2rem;"></i>
                    </label>
                    <input type="text" id="taskIdListDateRange" class="form-control" style="max-width: 200px;" readonly>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                    </div>
                    <br>
                    <h4 class="header-title">Data Task Id</h4>
                    <!-- Tambahkan table-responsive agar tabel bisa di-scroll jika lebarnya lebih besar dari layar -->
                    <div class="table-responsive">
                        <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Rawat</th>
                                    <th>Poli</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                <tr>
                                    <th></th> <!-- No (tidak difilter) -->
                                    <th><input type="text" class="form-control form-control-sm filter-col"
                                            placeholder="Cari Rawat"></th>
                                    <th><input type="text" class="form-control form-control-sm filter-col"
                                            placeholder="Cari Poli"></th>
                                    <th><input type="text" class="form-control form-control-sm filter-col"
                                            placeholder="Cari Tanggal"></th>
                                    <th><input type="text" class="form-control form-control-sm filter-col"
                                            placeholder="Cari Status"></th>
                                    <th></th> <!-- Aksi (tidak difilter) -->
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
    @include("SIMRS.taskId.jsTable")
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@append
