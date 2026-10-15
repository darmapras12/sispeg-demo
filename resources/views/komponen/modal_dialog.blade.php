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
                            <input type="text" name="nama_lengkap" class="form-control rounded-pill bg-light border-0 shadow-sm ps-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">NIP</label>
                            <input type="text" name="nip" class="form-control rounded-pill bg-light border-0 shadow-sm ps-3">
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
                                <input type="date" name="tmt_pangkat_monitoring" class="form-control rounded-pill bg-white border border-danger-subtle shadow-sm">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-primary text-uppercase">TMT Monitoring KGB</label>
                                <input type="date" name="tmt_kgb" class="form-control rounded-pill bg-white border border-primary-subtle shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 border-top pt-3">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-briefcase me-2"></i>Pangkat, Jabatan & Masa Kerja (Data Master)</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Gol/Ruang</label>
                                <select name="pangkat_golongan" class="form-select rounded-pill bg-light border-0 shadow-sm ps-3">
                                    <option value="">Pilih Golongan</option>
                                    <optgroup label="Golongan IV">
                                        <option value="Pembina Utama (IV/e)">Pembina Utama (IV/e)</option>
                                        <option value="Pembina Utama Madya (IV/d)">Pembina Utama Madya (IV/d)</option>
                                        <option value="Pembina Utama Muda (IV/c)">Pembina Utama Muda (IV/c)</option>
                                        <option value="Pembina Tk.I (IV/b)">Pembina Tk.I (IV/b)</option>
                                        <option value="Pembina (IV/a)">Pembina (IV/a)</option>
                                    </optgroup>
                                    <optgroup label="Golongan III">
                                        <option value="Penata Tk.I (III/d)">Penata Tk.I (III/d)</option>
                                        <option value="Penata (III/c)">Penata (III/c)</option>
                                        <option value="Penata Muda Tk.I (III/b)">Penata Muda Tk.I (III/b)</option>
                                        <option value="Penata Muda (III/a)">Penata Muda (III/a)</option>
                                    </optgroup>
                                    <optgroup label="Golongan II">
                                        <option value="Pengatur Tk.I (II/d)">Pengatur Tk.I (II/d)</option>
                                        <option value="Pengatur (II/c)">Pengatur (II/c)</option>
                                        <option value="Pengatur Muda Tk.I (II/b)">Pengatur Muda Tk.I (II/b)</option>
                                        <option value="Pengatur Muda (II/a)">Pengatur Muda (II/a)</option>
                                    </optgroup>
                                    <optgroup label="Golongan I">
                                        <option value="Juru Muda I (I/a)">Juru Muda I (I/a)</option>
                                        <option value="Juru Muda Tk.I (I/b)">Juru Muda Tk.I (I/b)</option>
                                        <option value="Juru I (I/c)">Juru I (I/c)</option>
                                        <option value="Juru TK.I (I/d)">Juru I (I/d)</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Pangkat T.M.T</label>
                                <input type="date" name="tmt_pangkat" class="form-control rounded-pill bg-light border-0 shadow-sm">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nama Jabatan</label>
                                <select name="jabatan" class="form-select rounded-pill bg-light border-0 shadow-sm ps-3">
                                    <option value="">Pilih Jabatan</option>
                                    <option value="">Pilih Jabatan</option>
                                    <optgroup label="Pimpinan Struktural">
                                        <option value="Kepala Balai Pemasyarakatan (Kabapas)">Kepala Balai Pemasyarakatan (Kabapas)</option>
                                        <option value="Kepala Urusan Tata Usaha (Kaur TU)">Kepala Urusan Tata Usaha (Kaur TU)</option>
                                        <option value="Kepala Sub Seksi Bimbingan Klien Anak">Kepala Sub Seksi Bimbingan Klien Anak</option>
                                        <option value="Kepala Subsi Bimbingan Klien Dewasa">Kepala Subsi Bimbingan Klien Dewasa</option>
                                    </optgroup>
                                    <optgroup label="Fungsional Fungsional (PK)">
                                        <option value="Pembimbing Kemasyarakatan (PK) Madya">Pembimbing Kemasyarakatan (PK) Madya</option>
                                        <option value="Pembimbing Kemasyarakatan (PK) Muda">Pembimbing Kemasyarakatan (PK) Muda</option>
                                        <option value="Pembimbing Kemasyarakatan (PK) Pertama">Pembimbing Kemasyarakatan (PK) Pertama</option>
                                    </optgroup>
                                    <optgroup label="Fungsional Keterampilan (APK)">
                                        <option value="Asisten Pembimbing Kemasyarakatan (APK) Penyelia">Asisten Pembimbing Kemasyarakatan (APK) Penyelia</option>
                                        <option value="Asisten Pembimbing Kemasyarakatan (APK) Mahir">Asisten Pembimbing Kemasyarakatan (APK) Mahir</option>
                                    </optgroup>
                                    <optgroup label="Pelaksana / Staff">
                                        <option value="Bendahara">Bendahara</option>
                                        <option value="Pengelola Kepegawaian">Pengelola Kepegawaian</option>
                                        <option value="Pengelola BMN">Pengelola BMN</option>
                                        <option value="Penelaah Status WBP">Penelaah Status WBP</option>
                                        <option value="Registrator Pemasyarakatan">Registrator Pemasyarakatan</option>
                                        <option value="Pranata KomputerPranata Komputer</option>
                                        <option value="Pengadministrasi Keuangan">Pengadministrasi Keuangan</option>
                                        <option value="Pengadministrasi Umum">Pengadministrasi Umum</option>
                                        <option value="Pembuat Daftar Gaji">Pembuat Daftar Gaji</option>
                                    </optgroup>
                                </select>
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
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label small fw-bold text-muted text-uppercase m-0">Jenjang/Nama</label>
                                    <a href="javascript:void(0)" class="text-decoration-none small fw-bold" style="font-size: 0.7rem;" onclick="tambahInput('container-jenjang', 'pendidikan_nama[]', 'Jenjang/Nama')">+ TAMBAH KOLOM JENJANG</a>
                                </div>
                                <div id="container-jenjang">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text border-0 bg-transparent fw-bold text-muted row-number">1.</span>
                                        <input type="text" name="pendidikan_nama[]" class="form-control rounded-pill bg-light border-0 shadow-sm ps-3" placeholder="Jenjang/Nama">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-2">
                                <div class="col-5">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label small fw-bold text-muted text-uppercase m-0">Tahun</label>
                                        <a href="javascript:void(0)" class="text-decoration-none small fw-bold" style="font-size: 0.7rem;" onclick="tambahInput('container-tahun', 'pendidikan_tahun[]', 'Tahun')">+ TAMBAH</a>
                                    </div>
                                    <div id="container-tahun">
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text border-0 bg-transparent fw-bold text-muted row-number">1.</span>
                                            <input type="number" name="pendidikan_tahun[]" class="form-control rounded-pill bg-light border-0 shadow-sm ps-3" placeholder="Tahun">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <label class="form-label small fw-bold text-muted text-uppercase mb-1">Ijazah</label>
                                    <input type="text" name="pendidikan_ijazah" class="form-control rounded-pill bg-light border-0 shadow-sm" placeholder="No. Ijazah">
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

<div class="modal fade" id="modalEditPegawai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold m-0 text-primary"><i class="bi bi-pencil-square me-2"></i>Edit Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formEditPegawai" method="POST">
                @csrf 
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-muted text-uppercase">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="edit_nama" class="form-control rounded-pill bg-light border-0 shadow-sm ps-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">NIP</label>
                            <input type="text" name="nip" id="edit_nip" class="form-control rounded-pill bg-light border-0 shadow-sm ps-3">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="edit_tgl_lahir" class="form-control rounded-pill bg-light border-0 shadow-sm">
                        </div>
                    </div>

                    <div class="mb-4 border-top pt-3">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-calendar-event me-2"></i>Data Monitoring KP & KGB</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-danger text-uppercase">TMT Monitoring KP (Dasar Hitung)</label>
                                <input type="date" name="tmt_pangkat_monitoring" id="edit_tmt_pangkat_monitoring" class="form-control rounded-pill bg-white border border-danger-subtle shadow-sm">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-primary text-uppercase">TMT Monitoring KGB</label>
                                <input type="date" name="tmt_kgb" id="edit_tmt_kgb" class="form-control rounded-pill bg-white border border-primary-subtle shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 border-top pt-3">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-briefcase me-2"></i>Pangkat, Jabatan & Masa Kerja (Data Master)</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Gol/Ruang</label>
                                <select name="pangkat_golongan" id="edit_golongan" class="form-select rounded-pill bg-light border-0 shadow-sm ps-3">
                                    <option value="">Pilih Golongan</option>
                                    <optgroup label="Golongan IV">
                                        <option value="Pembina Utama (IV/e)">Pembina Utama (IV/e)</option>
                                        <option value="Pembina Utama Madya (IV/d)">Pembina Utama Madya (IV/d)</option>
                                        <option value="Pembina Utama Muda (IV/c)">Pembina Utama Muda (IV/c)</option>
                                        <option value="Pembina Tk.I (IV/b)">Pembina Tk.I (IV/b)</option>
                                        <option value="Pembina (IV/a)">Pembina (IV/a)</option>
                                    </optgroup>
                                    <optgroup label="Golongan III">
                                        <option value="Penata Tk.I (III/d)">Penata Tk.I (III/d)</option>
                                        <option value="Penata (III/c)">Penata (III/c)</option>
                                        <option value="Penata Muda Tk.I (III/b)">Penata Muda Tk.I (III/b)</option>
                                        <option value="Penata Muda (III/a)">Penata Muda (III/a)</option>
                                    </optgroup>
                                    <optgroup label="Golongan II">
                                        <option value="Pengatur Tk.I (II/d)">Pengatur Tk.I (II/d)</option>
                                        <option value="Pengatur (II/c)">Pengatur (II/c)</option>
                                        <option value="Pengatur Muda Tk.I (II/b)">Pengatur Muda Tk.I (II/b)</option>
                                        <option value="Pengatur Muda (II/a)">Pengatur Muda (II/a)</option>
                                    </optgroup>
                                    <optgroup label="Golongan I">
                                        <option value="Juru Muda I (I/a)">Juru Muda I (I/a)</option>
                                        <option value="Juru Muda Tk.I (I/b)">Juru Muda Tk.I (I/b)</option>
                                        <option value="Juru I (I/c)">Juru I (I/c)</option>
                                        <option value="Juru TK.I (I/d)">Juru I (I/d)</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Pangkat T.M.T</label>
                                <input type="date" name="tmt_pangkat" id="edit_tmt_pangkat_master" class="form-control rounded-pill bg-light border-0 shadow-sm">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nama Jabatan</label>
                                <select name="jabatan" id="edit_jabatan" class="form-select rounded-pill bg-light border-0 shadow-sm ps-3">
                                    <option value="">Pilih Jabatan</option>
                                    <optgroup label="Pimpinan Struktural">
                                        <option value="Kepala Balai Pemasyarakatan (Kabapas)">Kepala Balai Pemasyarakatan (Kabapas)</option>
                                        <option value="Kepala Urusan Tata Usaha (Kaur TU)">Kepala Urusan Tata Usaha (Kaur TU)</option>
                                        <option value="Kepala Sub Seksi Bimbingan Klien Anak">Kepala Sub Seksi Bimbingan Klien Anak</option>
                                        <option value="Kepala Subsi Bimbingan Klien Dewasa">Kepala Subsi Bimbingan Klien Dewasa</option>
                                    </optgroup>
                                    <optgroup label="Fungsional Fungsional (PK)">
                                        <option value="Pembimbing Kemasyarakatan (PK) Madya">Pembimbing Kemasyarakatan (PK) Madya</option>
                                        <option value="Pembimbing Kemasyarakatan (PK) Muda">Pembimbing Kemasyarakatan (PK) Muda</option>
                                        <option value="Pembimbing Kemasyarakatan (PK) Pertama">Pembimbing Kemasyarakatan (PK) Pertama</option>
                                    </optgroup>
                                    <optgroup label="Fungsional Keterampilan (APK)">
                                        <option value="Asisten Pembimbing Kemasyarakatan (APK) Penyelia">Asisten Pembimbing Kemasyarakatan (APK) Penyelia</option>
                                        <option value="Asisten Pembimbing Kemasyarakatan (APK) Mahir">Asisten Pembimbing Kemasyarakatan (APK) Mahir</option>
                                    </optgroup>
                                    <optgroup label="Pelaksana / Staff">
                                        <option value="Bendahara">Bendahara</option>
                                        <option value="Pengelola Kepegawaian">Pengelola Kepegawaian</option>
                                        <option value="Pengelola BMN">Pengelola BMN</option>
                                        <option value="Penelaah Status WBP">Penelaah Status WBP</option>
                                        <option value="Registrator Pemasyarakatan">Registrator Pemasyarakatan</option>
                                        <option value="Pranata KomputerPranata Komputer</option>
                                        <option value="Pengadministrasi Keuangan">Pengadministrasi Keuangan</option>
                                        <option value="Pengadministrasi Umum">Pengadministrasi Umum</option>
                                        <option value="Pembuat Daftar Gaji">Pembuat Daftar Gaji</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Jabatan T.M.T</label>
                                <input type="date" name="tmt_jabatan" id="edit_tmt_jabatan" class="form-control rounded-pill bg-light border-0 shadow-sm">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-muted text-uppercase">MK THN</label>
                                <input type="number" name="mk_tahun" id="edit_mk_tahun" class="form-control rounded-pill bg-light border-0 shadow-sm">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-muted text-uppercase">MK BLN</label>
                                <input type="number" name="mk_bulan" id="edit_mk_bulan" class="form-control rounded-pill bg-light border-0 shadow-sm">
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
                                        <input type="text" name="diklat_nama[]" class="form-control border-0 bg-light rounded-start-pill ps-3 edit-diklat-nama" placeholder="Nama Diklat">
                                        <input type="text" name="diklat_tahun[]" class="form-control border-0 bg-light border-start edit-diklat-tahun" placeholder="Tahun" style="max-width: 80px;">
                                        <input type="text" name="diklat_durasi[]" class="form-control border-0 bg-light border-start rounded-end-pill edit-diklat-durasi" placeholder="Durasi" style="max-width: 90px;">
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                        
                        <div class="col-md-5 ps-3">
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-book me-2"></i>Riwayat Pendidikan</h6>
                            
                            <div id="edit-pendidikan-container" class="mb-2"></div>

                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill border-0 fw-bold" style="font-size: 0.7rem;" onclick="tambahBarisPendidikanEdit()">
                                <i class="bi bi-plus-circle me-1"></i>TAMBAH RIWAYAT PENDIDIKAN
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow">SIMPAN PERUBAHAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
/** * FUNGSI MODAL TAMBAH (Original)
 */
function tambahInput(containerId, inputName, placeholder) {
    const container = document.getElementById(containerId);
    if(!container) return;
    const currentRows = container.getElementsByClassName('input-group').length;
    const nextRowNumber = currentRows + 1;
    const div = document.createElement('div');
    div.className = 'input-group input-group-sm mb-2 animate__animated animate__fadeInDown';
    const type = inputName.includes('tahun') ? 'number' : 'text';
    const inputClass = "form-control rounded-pill bg-light border-0 shadow-sm ps-3";

    div.innerHTML = `
        <span class="input-group-text border-0 bg-transparent fw-bold text-muted row-number">${nextRowNumber}.</span>
        <input type="${type}" name="${inputName}" class="${inputClass}" placeholder="${placeholder}">
    `;
    container.appendChild(div);
}

/** * FUNGSI MODAL EDIT (Perbaikan Logika Kontainer Kosong)
 */

// 1. Fungsi merender satu baris input (Sama seperti tampilan Master)
function renderBarisPendidikanEdit(nomor, nama, tahun, ijazah = '') {
    const container = document.getElementById('edit-pendidikan-container');
    if(!container) return;
    
    const div = document.createElement('div');
    div.className = 'mb-3 pb-2 border-bottom animate__animated animate__fadeIn';
    div.innerHTML = `
        <div class="mb-2">
            <div class="input-group input-group-sm">
                <span class="input-group-text border-0 bg-transparent fw-bold text-muted">${nomor}.</span>
                <input type="text" name="pendidikan_nama[]" class="form-control rounded-pill bg-light border-0 ps-3" 
                       placeholder="Jenjang/Nama" value="${nama || ''}">
            </div>
        </div>
        <div class="row g-2 ms-3">
            <div class="col-5">
                <input type="number" name="pendidikan_tahun[]" class="form-control form-control-sm rounded-pill bg-light border-0 ps-3" 
                       placeholder="Tahun" value="${tahun || ''}">
            </div>
            <div class="col-7">
                <input type="text" name="pendidikan_ijazah[]" class="form-control form-control-sm rounded-pill bg-light border-0 ps-3" 
                       placeholder="No. Ijazah" value="${ijazah || ''}">
            </div>
        </div>
    `;
    container.appendChild(div);
}

// 2. Fungsi tombol tambah di modal edit
function tambahBarisPendidikanEdit() {
    const container = document.getElementById('edit-pendidikan-container');
    const nomorBaru = container.children.length + 1;
    renderBarisPendidikanEdit(nomorBaru, '', '', '');
}

// 3. Fungsi Utama Buka Modal (DIPANGGIL OLEH TOMBOL EDIT)
function bukaModalEdit(data) {
    const form = document.getElementById('formEditPegawai');
    form.reset();
    form.action = `/pegawai/${data.id}`;
    
    // Reset kontainer pendidikan
    const containerPen = document.getElementById('edit-pendidikan-container');
    if(containerPen) containerPen.innerHTML = '';

    // Isi Field Dasar
    document.getElementById('edit_nama').value = data.nama_lengkap || '';
    document.getElementById('edit_nip').value = data.nip || '';
    document.getElementById('edit_tgl_lahir').value = data.tanggal_lahir || '';
    document.getElementById('edit_tmt_pangkat_monitoring').value = data.tmt_pangkat_monitoring || '';
    document.getElementById('edit_tmt_kgb').value = data.tmt_kgb || '';
    document.getElementById('edit_golongan').value = data.pangkat_golongan || '';
    document.getElementById('edit_tmt_pangkat_master').value = data.tmt_pangkat || '';
    document.getElementById('edit_jabatan').value = data.jabatan || '';
    document.getElementById('edit_tmt_jabatan').value = data.tmt_jabatan || '';
    document.getElementById('edit_mk_tahun').value = data.mk_tahun || 0;
    document.getElementById('edit_mk_bulan').value = data.mk_bulan || 0;

    // LOGIKA PENDIDIKAN: Jika data kosong, tetep tampilin 1 baris input biar user bisa isi
    if (data.pendidikans && data.pendidikans.length > 0) {
        data.pendidikans.forEach((pen, index) => {
            renderBarisPendidikanEdit(index + 1, pen.pendidikan_nama, pen.pendidikan_tahun, pen.pendidikan_ijazah);
        });
    } else {
        // INI SOLUSI AGAR TIDAK KOSONG:
        renderBarisPendidikanEdit(1, '', '', '');
    }

    // Isi Data Diklat (Maksimal 4)
    const namaDiklat = document.querySelectorAll('.edit-diklat-nama');
    const tahunDiklat = document.querySelectorAll('.edit-diklat-tahun');
    const durasiDiklat = document.querySelectorAll('.edit-diklat-durasi');

    if (data.diklats) {
        data.diklats.forEach((dik, i) => {
            if(i < 4) {
                namaDiklat[i].value = dik.diklat_nama || '';
                tahunDiklat[i].value = dik.diklat_tahun || '';
                durasiDiklat[i].value = dik.diklat_durasi || '';
            }
        });
    }

    const modalEdit = new bootstrap.Modal(document.getElementById('modalEditPegawai'));
    modalEdit.show();
}
</script>