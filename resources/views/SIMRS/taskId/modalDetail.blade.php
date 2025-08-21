<div id="info-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- pakai modal-xl untuk tabel -->
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="info-header-modalLabel">Log Task Id</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped dt-responsive nowrap w-100" id="TaskIdLogTable">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>No Rawat</th>
                                <th>Task Id</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Log</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="3" style="text-align:right">Total Waktu:</th>
                                <th id="totalWaktu"></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
