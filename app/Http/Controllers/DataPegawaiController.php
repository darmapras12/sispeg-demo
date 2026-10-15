@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp

{{-- 1. MODAL TAMBAH PEGAWAI (KHUSUS DASHBOARD - SIMPEL) --}}
<div class="modal fade" id="modalTambahPegawaiDashboard" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold m-0"><i class="bi bi-speedometer2 me-2 text-primary"></i>Tambah Pegawai (Dashboard)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pegawai.store') }}" method="POST">
                @csrf
                <input type="hidden" name="is_dashboard_only" value="1">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">NIP</label>
                            <input type="text" name="nip" class="form-control rounded-pill px-3" placeholder="Masukkan NIP" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control rounded-pill px-3" placeholder="Nama Lengkap & Gelar" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold text-muted">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control rounded-pill px-3" placeholder="Jabatan" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">TMT Pangkat Terakhir</label>
                            <input type="date" name="tmt_pangkat" class="form-control rounded-pill px-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">TMT KGB Terakhir</label>
                            <input type="date" name="tmt_kgb" class="form-control rounded-pill px-3" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Dashboard</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 2. MODAL TAMBAH PEGAWAI (KHUSUS DATA PEGAWAI - LENGKAP) --}}
<div class="modal fade" id="modalTambahPegawaiMaster" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold m-0"><i class="bi bi-database-add me-2 text-success"></i>Tambah Pegawai (Master Data)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pegawai.store') }}" method="POST">
                @csrf
                <input type="hidden" name="is_dashboard_only" value="0">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                            <input type="text" name="nama_lengkap" class="form-control rounded-pill px-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">NIP</label>
                            <input type="text" name="nip" class="form-control rounded-pill px-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">PANGKAT (GOL)</label>
                            <input type="text" name="pangkat_golongan" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">TMT PANGKAT</label>
                            <input type="date" name="tmt_pangkat" class="form-control rounded-pill px-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">TGL LAHIR</label>
                            <input type="date" name="tanggal_lahir" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small fw-bold text-muted">JABATAN</label>
                            <input type="text" name="jabatan" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">TMT JABATAN</label>
                            <input type="date" name="tmt_jabatan" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">MK (THN)</label>
                            <input type="number" name="mk_tahun" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">MK (BLN)</label>
                            <input type="number" name="mk_bulan" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">TMT KGB (Opsional)</label>
                            <input type="date" name="tmt_kgb" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-12"><hr></div>
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-muted">NAMA DIKLAT</label>
                            <input type="text" name="diklat_nama" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">THN DIKLAT</label>
                            <input type="number" name="diklat_tahun" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">DURASI (JAM)</label>
                            <input type="text" name="diklat_durasi" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-muted">PENDIDIKAN</label>
                            <input type="text" name="pendidikan_nama" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">THN LULUS</label>
                            <input type="number" name="pendidikan_tahun" class="form-control rounded-pill px-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">IJAZAH</label>
                            <input type="text" name="pendidikan_ijazah" class="form-control rounded-pill px-3">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4 text-white">Simpan Data Master</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT, HAPUS, DLL TETAP SAMA --}}