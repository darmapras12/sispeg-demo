<button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">
    <i class="bi bi-person-plus-fill me-2"></i>Tambah Pegawai Baru
</button>

<div class="modal fade" id="modalTambahPegawai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold m-0 text-primary"><i class="bi bi-clipboard-data me-2"></i>Formulir Pegawai Terpadu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('pegawai.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-muted text-uppercase">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control rounded-pill bg-light border-0 shadow-sm ps-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">NIP</label>
                            <input type="text" name="nip" class="form-control rounded-pill bg-light border-0 shadow-sm ps-3" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control rounded-pill bg-light border-0 shadow-sm">
                        </div>
                    </div>

                    <div class="mb-4 border-top pt-3">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-calendar-event me-2"></i>Data Monitoring KP & KGB</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-danger text-uppercase">TMT Monitoring KP (Dasar Hitung)</label>
                                <input type="date" name="tmt_pangkat_monitoring" class="form-control rounded-pill bg-white border border-danger-subtle shadow-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-primary text-uppercase">TMT Monitoring KGB</label>
                                <input type="date" name="tmt_kgb" class="form-control rounded-pill bg-white border border-primary-subtle shadow-sm" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 border-top pt-3">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-briefcase me-2"></i>Pangkat, Jabatan & Masa Kerja (Data Master)</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Gol/Ruang</label>
                                <input type="text" name="pangkat_golongan" class="form-control rounded-pill bg-light border-0 shadow-sm">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Pangkat T.M.T</label>
                                <input type="date" name="tmt_pangkat" class="form-control rounded-pill bg-light border-0 shadow-sm" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nama Jabatan</label>
                                <input type="text" name="jabatan" class="form-control rounded-pill bg-light border-0 shadow-sm">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Jabatan T.M.T</label>
                                <input type="date" name="tmt_jabatan" class="form-control rounded-pill bg-light border-0 shadow-sm">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-muted text-uppercase">MK THN</label>
                                <input type="number" name="mk_tahun" class="form-control rounded-pill bg-light border-0 shadow-sm">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-muted text-uppercase">MK BLN</label>
                                <input type="number" name="mk_bulan" class="form-control rounded-pill bg-light border-0 shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="row border-top pt-3">
                        <div class="col-md-7 border-end">
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-mortarboard me-2"></i>Daftar Diklat</h6>
                            <div class="row g-2">
                                @for($i = 0; $i < 4; $i++)
                                <div class="col-12">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text border-0 bg-transparent fw-bold text-muted">{{ $i + 1 }}.</span>
                                        <input type="text" name="diklat_nama[]" class="form-control border-0 bg-light rounded-start-pill ps-3" placeholder="Nama Diklat">
                                        <input type="text" name="diklat_tahun[]" class="form-control border-0 bg-light border-start" placeholder="Tahun" style="max-width: 80px;">
                                        <input type="text" name="diklat_durasi[]" class="form-control border-0 bg-light border-start rounded-end-pill" placeholder="Durasi" style="max-width: 90px;">
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                        <div class="col-md-5 ps-3">
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-book me-2"></i>Pendidikan Terakhir</h6>
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-muted text-uppercase">Jenjang/Nama</label>
                                <input type="text" name="pendidikan_nama" class="form-control rounded-pill bg-light border-0 shadow-sm">
                            </div>
                            <div class="row g-2">
                                <div class="col-5">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Tahun</label>
                                    <input type="number" name="pendidikan_tahun" class="form-control rounded-pill bg-light border-0 shadow-sm">
                                </div>
                                <div class="col-7">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Ijazah</label>
                                    <input type="text" name="pendidikan_ijazah" class="form-control rounded-pill bg-light border-0 shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted small" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow">
                        <i class="bi bi-check-circle-fill me-2"></i>SIMPAN DATA TERPADU
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>