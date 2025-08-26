<div id="TaskIdMjknModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="TaskIdMjknModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- modal besar -->
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="TaskIdMjknModalLabel">Task ID Mjkn</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="taskTabMjkn" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="terkirim-mjkn-tab" data-bs-toggle="tab"
                            data-bs-target="#terkirim-mjkn" type="button" role="tab" aria-controls="terkirim-mjkn"
                            aria-selected="true">
                            ✅ Terkirim
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="belum-mjkn-tab" data-bs-toggle="tab" data-bs-target="#belum-mjkn"
                            type="button" role="tab" aria-controls="belum-mjkn" aria-selected="false">
                            ⏳ Belum Terkirim
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="taskTabMjknContent">
                    <!-- Tab Terkirim -->
                    <div class="tab-pane fade show active" id="terkirim-mjkn" role="tabpanel"
                        aria-labelledby="terkirim-mjkn-tab">
                        <div class="table-responsive">
                            <table class="table table-striped dt-responsive nowrap w-100" id="TaskIdMjknTerkirimTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>No Rawat</th>
                                        <th>Nama</th>
                                        <th>Poli</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <!-- Tab Belum Terkirim -->
                    <div class="tab-pane fade" id="belum-mjkn" role="tabpanel" aria-labelledby="belum-mjkn-tab">
                        <div class="table-responsive">
                            <table class="table table-striped dt-responsive nowrap w-100" id="TaskIdBelumMjknTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>No Rawat</th>
                                        <th>Nama</th>
                                        <th>Poli</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
