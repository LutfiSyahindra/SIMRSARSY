<div id="info-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- pakai modal-xl untuk tabel -->
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="info-header-modalLabel">Log WhatsApp</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="logWaTable">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Pesan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- akan diisi lewat JS -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
