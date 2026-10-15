<div class="area-aksi-tabel d-flex justify-content-end align-items-center animasi-muncul">
    <div class="d-flex gap-3">
        <a href="{{ route('pegawai.export') }}?tab={{ $tipeAktif }}" id="btnExportExcel" class="btn btn-outline-success rounded-pill px-4 fw-bold border-2 shadow-sm">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
        </a>
        
        <button type="button" class="btn btn-tambah shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">
            <i class="bi bi-plus-lg me-1"></i> Tambah Pegawai
        </button>
    </div>
</div>

<div class="wadah-tabel animasi-muncul">
    <form action="{{ route('pegawai.bulkDestroy') }}" method="POST" id="formHapusMassal">
        @csrf
        @method('DELETE')

        <div class="header-tabel-area d-flex justify-content-between align-items-center p-4 bg-white border-bottom">
            <div class="d-flex align-items-center gap-3">
                <h6 class="fw-bold m-0" id="judul-tabel">
                    <i class="bi bi-table me-2 text-primary"></i>
                    Daftar {{ $tipeAktif == 'total' ? 'Seluruh Pegawai' : ($tipeAktif == 'kp' ? 'Mendekati Waktu KP' : 'Mendekati Waktu KGB') }}
                </h6>
                <div id="btnHapusMassalWrapper" style="display: {{ $tipeAktif == 'total' ? 'block' : 'none' }};">
                    <button type="submit" id="btnBulkDelete" class="btn btn-danger btn-sm rounded-pill px-3 fw-bold" disabled
                        onclick="return confirm('Apakah anda ingin menghapus data?')">
                        <i class="bi bi-trash-fill me-1"></i> Hapus Terpilih
                    </button>
                </div>
            </div>

            <div class="search-box position-relative w-25">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" id="inputCari" class="form-control ps-5 rounded-pill border-light shadow-sm" placeholder="Cari data..." onkeyup="fiturCari()">
            </div>
        </div>
        
        <div id="konten-tabel-dinamis" class="table-hover-custom">
            @include('komponen.tabel_monitoring', ['data' => $dataTabel, 'tipe' => $tipeAktif])
        </div>
    </form>
</div>