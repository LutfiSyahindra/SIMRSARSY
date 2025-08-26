<div id="info-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- modal besar -->
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="info-header-modalLabel">Task ID Onsite</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="taskTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="terkirim-tab" data-bs-toggle="tab"
                            data-bs-target="#terkirim" type="button" role="tab" aria-controls="terkirim"
                            aria-selected="true">
                            ✅ Terkirim
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="belum-tab" data-bs-toggle="tab" data-bs-target="#belum"
                            type="button" role="tab" aria-controls="belum" aria-selected="false">
                            ⏳ Belum Terkirim
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="taskTabContent">
                    <!-- Tab Terkirim -->
                    <div class="tab-pane fade show active" id="terkirim" role="tabpanel"
                        aria-labelledby="terkirim-tab">
                        <div class="table-responsive">
                            <table class="table table-striped dt-responsive nowrap w-100"
                                id="TaskIdOnsiteTerkirimTable">
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
                    <div class="tab-pane fade" id="belum" role="tabpanel" aria-labelledby="belum-tab">
                        <div class="table-responsive">
                            <table class="table table-striped dt-responsive nowrap w-100" id="TaskIdOnsiteBelumTable">
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
