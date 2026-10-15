<div class="modal fade" id="modalUploadBerkas" tabindex="-1" aria-labelledby="modalUploadBerkasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUploadBerkasLabel">
                    <i class="bi bi-file-earmark-arrow-up-fill text-primary me-2"></i>Upload Berkas Pegawai
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pegawai.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="pegawai_id" class="form-label fw-bold">Pilih Pegawai</label>
                        <select name="pegawai_id" id="pegawai_id" class="form-select select2-pegawai" style="width: 100%;" required>
                            <option value="">-- Cari Nama atau NIP Pegawai --</option>
                            @foreach($semuaPegawai as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->nama_lengkap }} - NIP. {{ $p->nip ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan_dokumen" class="form-label fw-bold">Keterangan / Nama Dokumen</label>
                        <input type="text" name="keterangan_dokumen" id="keterangan_dokumen" list="kategori-saran" class="form-control" placeholder="Contoh: Ijazah S1, Sertifikat Diklat, SK Pangkat" required autocomplete="off">
                        
                        <datalist id="kategori-saran">
                            <option value="Ijazah S1">
                            <option value="Ijazah S2">
                            <option value="Sertifikat Diklat">
                            <option value="SK Kenaikan Pangkat">
                            <option value="SK Kenaikan Gaji Berkala">
                            <option value="SK CPNS">
                            <option value="SK PNS">
                        </datalist>
                        <div class="form-text text-muted">Admin bebas mengetik manual nama dokumen jika tidak ada di saran.</div>
                    </div>

                    <div class="mb-3">
                        <label for="file_dokumen" class="form-label fw-bold">Pilih Berkas Dokumen</label>
                        <input type="file" name="file_dokumen" id="file_dokumen" class="form-control" required>
                        <div class="form-text text-danger">* Format: PDF, JPG, JPEG, PNG (Maksimal 2 MB).</div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Mulai Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pastikan jQuery dan Select2 sudah termuat di monitoring.blade.php
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('.select2-pegawai').select2({
                dropdownParent: $('#modalUploadBerkas'),
                placeholder: "-- Cari Nama atau NIP Pegawai --",
                allowClear: true
            });
        }
    });
</script>