<div class="modal fade" id="modalKonfirmasiMutasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold" style="color: var(--primary-slate);"><i class="bi bi-arrow-left-right me-2 text-warning"></i>Konfirmasi Mutasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formActionMutasi" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="p-3 mb-3" style="background: #fff9db; border-radius: 12px; border-left: 4px solid #fab005;">
                        <p class="small mb-1 text-muted">Anda akan memindahkan status pegawai berikut menjadi <strong>Mutasi</strong>:</p>
                        <div class="fw-bold text-dark" id="text_mutasi_nama"></div>
                        <div class="small text-muted" id="text_mutasi_nip"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small" style="color: var(--primary-slate);">Tanggal Efektif Mutasi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;"><i class="bi bi-calendar-event text-muted"></i></span>
                            <input type="date" name="tanggal_mutasi" class="form-control border-start-0" style="border-radius: 0 10px 10px 0; font-size: 0.85rem;">
                        </div>
                        <div class="form-text x-small text-muted mt-1">Jika tidak diisi, maka di tabel akan muncul strip (-).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small" style="color: var(--primary-slate);">Catatan / Alasan Mutasi</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Contoh: Pindah tugas ke Bapas Kelas I..." style="border-radius: 10px; font-size: 0.85rem;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light fw-bold px-4" data-bs-dismiss="modal" style="border-radius: 10px; font-size: 0.85rem;">Batal</button>
                    <button type="submit" class="btn btn-warning fw-bold px-4 text-white" style="border-radius: 10px; font-size: 0.85rem;">Proses Mutasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKonfirmasiPensiun" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold" style="color: var(--primary-slate);"><i class="bi bi-person-down me-2 text-danger"></i>Konfirmasi Pensiun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formActionPensiun" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="p-3 mb-3" style="background: #fff5f5; border-radius: 12px; border-left: 4px solid #fa5252;">
                        <p class="small mb-1 text-muted">Anda akan memproses purna tugas untuk pegawai:</p>
                        <div class="fw-bold text-dark" id="text_pensiun_nama"></div>
                        <div class="small text-muted" id="text_pensiun_nip"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small" style="color: var(--primary-slate);">Tanggal Purna Tugas (Pensiun)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;"><i class="bi bi-calendar-check text-muted"></i></span>
                            <input type="date" name="tanggal_pensiun" class="form-control border-start-0" style="border-radius: 0 10px 10px 0; font-size: 0.85rem;">
                        </div>
                        <div class="form-text x-small text-muted mt-1">Jika tidak diisi, maka di tabel akan muncul strip (-).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small" style="color: var(--primary-slate);">Catatan Pensiun</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Contoh: Memasuki masa purna tugas TMT..." style="border-radius: 10px; font-size: 0.85rem;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light fw-bold px-4" data-bs-dismiss="modal" style="border-radius: 10px; font-size: 0.85rem;">Batal</button>
                    <button type="submit" class="btn btn-danger fw-bold px-4" style="border-radius: 10px; font-size: 0.85rem;">Konfirmasi Pensiun</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
    .form-control:focus {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
    }
</style>