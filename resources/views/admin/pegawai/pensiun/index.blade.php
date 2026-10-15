<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pensiun - SISPEG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --primary-slate: #1e293b; --accent-red: #e11d48; --border-color: #e2e8f0; --text-main: #334155; --lebar-samping: 260px; --lebar-samping-mini: 80px; }
        body { font-family: 'Plus Jakarta Sans', sans-serif !important; margin: 0 !important; min-height: 100vh; background-color: #ffffff; background-image: radial-gradient(#cbd5e1 0.8px, transparent 0.8px), radial-gradient(at 0% 0%, rgba(225, 29, 72, 0.03) 0px, transparent 40%), radial-gradient(at 100% 100%, rgba(2, 132, 199, 0.05) 0px, transparent 40%), linear-gradient(135deg, #f8fafc 0%, #ffffff 100%); background-size: 30px 30px, 100% 100%, 100% 100%, 100% 100%; background-attachment: fixed; color: var(--text-main); letter-spacing: -0.01em; overflow-x: hidden; }
        .konten-utama { margin-left: var(--lebar-samping); padding: 40px; transition: margin-left 0.4s cubic-bezier(0.25, 1, 0.5, 1); }
        .sidebar-is-mini .konten-utama { margin-left: var(--lebar-samping-mini) !important; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animasi-tabel { animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .alert-custom-box { position: relative; background-color: #0f172a; color: white; padding: 20px 25px; border-radius: 15px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2); overflow: hidden; animation: slideDownIn 0.4s ease-out; }
        @keyframes slideDownIn { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .progress-bar-moving { position: absolute; bottom: 0; left: 0; height: 3px; background: var(--accent-red); width: 100%; animation: moveProgress 5s linear forwards; }
        @keyframes moveProgress { from { width: 100%; } to { width: 0%; } }
        .wadah-tabel { background: rgba(255, 255, 255, 0.95) !important; backdrop-filter: blur(8px); padding: 0 !important; border-radius: 20px !important; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.03), 0 20px 40px -10px rgba(30, 41, 59, 0.1); border: 1px solid rgba(226, 232, 240, 0.8) !important; margin-top: 24px !important; overflow: hidden; }
        .table-custom thead th { color: var(--primary-slate) !important; text-align: center !important; vertical-align: middle !important; padding: 20px 12px !important; font-weight: 700 !important; text-transform: uppercase !important; background-color: #f8fafc !important; border-bottom: 2px solid var(--border-color) !important; border-right: 1px solid var(--border-color) !important; }
        .table-custom tbody tr:hover td { background-color: #fff1f2 !important; border-top: 1px solid var(--accent-red) !important; border-bottom: 1px solid var(--accent-red) !important; }
        .table-custom tbody tr:hover td:first-child { border-left: 4px solid var(--accent-red) !important; }
        .table-custom tbody td { padding: 18px 12px !important; border: none !important; vertical-align: middle !important; border-bottom: 1px solid var(--border-color) !important; }
        .input-search-custom { width: 320px; padding: 10px 15px 10px 40px; border-radius: 12px; border: 1px solid var(--border-color); background: white; outline: none; transition: all 0.3s; font-size: 0.85rem; }
        .status-badge-pensiun { background-color: #ffe4e6; color: #be123c; font-weight: 700; font-size: 0.65rem; padding: 6px 12px; border-radius: 6px; border: 1px solid #fecdd3; text-transform: uppercase; }
        .nip-style { font-family: 'Courier New', monospace; font-size: 0.75rem; color: #64748b; font-weight: 600; }
        
        /* Pengaturan ukuran tombol berkas agar rapi & proporsional */
        .style-btn-aksi {
            font-size: 0.75rem !important;
            padding: 6px 16px !important;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            box-shadow: 0 2px 4px rgba(225, 29, 72, 0.15);
            transition: all 0.2s ease-in-out;
        }
        .style-btn-aksi:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(225, 29, 72, 0.25);
        }

        /* Gaya untuk tombol berkas yang dinonaktifkan (kosong) */
        .style-btn-aksi-disabled {
            font-size: 0.75rem !important;
            padding: 6px 16px !important;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            background-color: #cbd5e1 !important;
            border-color: #cbd5e1 !important;
            color: #64748b !important;
            cursor: not-allowed !important;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    @include('komponen.banner_demo')
    @include('komponen.bilah_samping')
    <main class="konten-utama">
        <div class="header-atas d-flex justify-content-between align-items-end mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2" style="font-size: 0.75rem;">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted opacity-75">Sistem Informasi</a></li>
                        <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: var(--accent-red);">Pegawai Pensiun</li>
                    </ol>
                </nav>
                <h3 class="fw-bold m-0" style="color: var(--primary-slate); letter-spacing: -1px; font-size: 2rem;">Data Pegawai Pensiun</h3>
            </div>
            <div class="d-flex gap-3 align-items-center">
                <div class="position-relative">
                    <i class="bi bi-search" style="position: absolute; left: 15px; top: 12px; color: #94a3b8;"></i>
                    <input type="text" id="searchInput" class="input-search-custom" placeholder="Cari Nama atau NIP...">
                </div>
                
                <button type="submit" id="btnBulkRestore" form="formAksiMassal" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm" disabled onclick="changeFormActionAndSubmit('{{ route('pensiun.bulkRestore') }}', 'Apakah Anda yakin ingin membatalkan status pensiun dan mengembalikan pegawai yang dipilih ke status Aktif di Dashboard?')">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Kembalikan Terpilih
                </button>

                <button type="submit" id="btnBulkDelete" form="formAksiMassal" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm" disabled onclick="changeFormActionAndSubmit('{{ route('pegawai.bulkDestroy') }}', 'Apakah Anda yakin ingin menghapus data pensiun yang dipilih?')">
                    <i class="bi bi-trash-fill me-1"></i> Hapus Terpilih
                </button>
            </div>
        </div>

        @if(session('success'))
        <div class="alert-custom-box" id="successAlert">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-3 fs-4" style="color: #fb7185;"></i>
                <div><strong class="d-block">Sistem Informasi</strong><span class="small opacity-75">{{ session('success') }}</span></div>
            </div>
            <div class="progress-bar-moving"></div>
        </div>
        @endif

        <div class="wadah-tabel animasi-tabel">
            <form action="" method="POST" id="formAksiMassal">
                @csrf 
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="table-responsive">
                    <table class="table table-custom" id="pegawaiTable">
                        <thead>
                            <tr>
                                <th width="40"><input type="checkbox" id="checkAll" style="cursor: pointer; transform: scale(1.2);"></th>
                                <th width="50">NO</th>
                                <th class="text-start">NAMA LENGKAP</th>
                                <th>NIP</th>
                                <th>JABATAN TERAKHIR</th>
                                <th>PANGKAT/GOL</th>
                                <th>TGL PENSIUN</th>
                                <th>CATATAN</th>
                                <th>STATUS</th>
                                <th width="120">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="pegawaiTableBody">
                            @forelse($pegawais as $index => $p)
                            <tr class="pegawai-row" onclick="toggleRow(event, this)">
                                <td class="text-center"><input type="checkbox" name="ids[]" value="{{ $p->id }}" class="check-item" style="transform: scale(1.2);"></td>
                                <td class="text-center text-muted fw-bold">{{ $index + 1 }}</td>
                                <td><div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $p->nama_lengkap }}</div></td>
                                <td class="text-center nip-style">{{ $p->nip }}</td>
                                <td>{{ $p->jabatan ?? '-' }}</td>
                                <td class="text-center"><span class="fw-medium text-secondary">{{ $p->pangkat_golongan ?? '-' }}</span></td>
                                <td class="text-center fw-medium">{{ $p->tanggal_pensiun ? \Carbon\Carbon::parse($p->tanggal_pensiun)->format('d/m/Y') : '-' }}</td>
                                <td class="text-muted small italic">{{ $p->catatan_status ?? '-' }}</td>
                                <td class="text-center"><span class="status-badge-pensiun">Pensiun</span></td>
                                <td class="text-center">
                                    @if($p->dokumens && $p->dokumens->count() > 0)
                                        <a href="/admin/dokumen?pegawai_id={{ $p->id }}" class="btn btn-danger rounded-pill fw-bold style-btn-aksi">
                                            <i class="bi bi-folder-fill"></i> Berkas
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-secondary rounded-pill fw-bold style-btn-aksi-disabled" disabled title="Belum ada berkas yang diunggah">
                                            <i class="bi bi-folder-x"></i> Berkas
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="10" class="text-center py-5 text-muted small italic">Belum ada data pegawai pensiun.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('successAlert');
            if(alert) {
                setTimeout(() => {
                    alert.style.transition = '0.5s ease';
                    alert.style.transform = 'translateY(-20px)';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            }
            const checkAll = document.getElementById('checkAll');
            const checkItems = document.querySelectorAll('.check-item');
            const btnBulkDelete = document.getElementById('btnBulkDelete');
            const btnBulkRestore = document.getElementById('btnBulkRestore');
            
            function updateBulkDeleteButton() {
                const checkedCount = document.querySelectorAll('.check-item:checked').length;
                btnBulkDelete.disabled = (checkedCount === 0);
                if (btnBulkRestore) {
                    btnBulkRestore.disabled = (checkedCount === 0);
                }
            }
            if(checkAll) {
                checkAll.addEventListener('change', function() {
                    checkItems.forEach(item => { if(item.closest('tr').style.display !== 'none') { item.checked = this.checked; } });
                    updateBulkDeleteButton();
                });
            }
            checkItems.forEach(item => { item.addEventListener('change', updateBulkDeleteButton); });
            document.getElementById('searchInput').addEventListener('keyup', function() {
                let val = this.value.toLowerCase();
                document.querySelectorAll('.pegawai-row').forEach(row => { row.style.display = row.innerText.toLowerCase().includes(val) ? "" : "none"; });
            });
        });

        function toggleRow(event, row) {
            if (event.target.type === 'checkbox' || event.target.tagName === 'A' || event.target.closest('a')) return;
            const cb = row.querySelector('.check-item');
            if(cb) { cb.checked = !cb.checked; cb.dispatchEvent(new Event('change')); }
        }

        function changeFormActionAndSubmit(routeUrl, confirmMessage) {
            event.preventDefault();
            if (confirm(confirmMessage)) {
                const form = document.getElementById('formAksiMassal');
                const methodInput = document.getElementById('formMethod');
                
                form.action = routeUrl;
                
                if (routeUrl.includes('hapus-banyak')) {
                    methodInput.value = 'DELETE';
                } else {
                    methodInput.value = 'POST';
                }
                
                form.submit();
            }
        }
    </script>
</body>
</html>