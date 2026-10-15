<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Master Pegawai - SISPEG</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root { 
            --primary-slate: #1e293b; 
            --accent-master: #6366f1; /* Indigo */
            --border-color: #e2e8f0;
            --text-main: #334155;
            --lebar-samping: 260px;
            --lebar-samping-mini: 80px;
        }

        /* --- BACKGROUND MESH + GEOMETRIC --- */
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif !important; 
            margin: 0 !important; 
            min-height: 100vh;
            background-color: #ffffff;
            background-image: 
                radial-gradient(#cbd5e1 0.8px, transparent 0.8px), 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.1) 0px, transparent 40%), 
                radial-gradient(at 100% 100%, rgba(168, 85, 247, 0.05) 0px, transparent 40%),
                linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            background-size: 30px 30px, 100% 100%, 100% 100%, 100% 100%;
            background-attachment: fixed;
            color: var(--text-main);
            letter-spacing: -0.01em;
            overflow-x: hidden;
        }

        .konten-utama { 
            margin-left: var(--lebar-samping); 
            padding: 40px; 
            transition: margin-left 0.4s cubic-bezier(0.25, 1, 0.5, 1); 
        }

        .sidebar-is-mini .konten-utama { 
            margin-left: var(--lebar-samping-mini) !important; 
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animasi-muncul {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* --- WADAH TABEL MELENGKUNG --- */
        .wadah-tabel { 
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(8px);
            padding: 0 !important; 
            border-radius: 20px !important; 
            box-shadow: 
                0 10px 15px -3px rgba(0, 0, 0, 0.03), 
                0 20px 40px -10px rgba(99, 102, 241, 0.1), 
                0 0 0 1px rgba(255, 255, 255, 0.5) inset !important; 
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            margin-top: 24px !important;
            overflow: hidden;
        }

        /* --- TABLE STYLE --- */
        .table-custom { 
            font-size: 0.75rem !important; 
            width: 100% !important; 
            border-collapse: separate !important; 
            border-spacing: 0 !important; 
        }

        .table-custom thead th { 
            color: var(--primary-slate) !important; 
            text-align: center !important; 
            vertical-align: middle !important; 
            padding: 15px 8px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            background-color: #f1f5f9 !important; 
            border-bottom: 2px solid var(--border-color) !important;
            border-right: 1px solid var(--border-color) !important;
        }

        .table-custom thead th:last-child { border-right: none !important; }

        .table-custom tbody tr { 
            background: transparent !important; 
            transition: background-color 0.2s ease !important; 
        }

        .table-custom tbody tr:hover td {
            background-color: #f5f3ff !important; 
            border-top: 1px solid var(--accent-master) !important;
            border-bottom: 1px solid var(--accent-master) !important;
        }
        
        .table-custom tbody tr:hover td:first-child { border-left: 3px solid var(--accent-master) !important; }

        .table-custom tbody td { 
            padding: 12px 8px !important; 
            border: none !important;
            vertical-align: middle !important;
            border-bottom: 1px solid var(--border-color) !important;
        }

        .sticky-col { 
            position: sticky !important; left: 0 !important; z-index: 2 !important; 
            background-color: white !important; 
            border-right: 2px solid var(--border-color) !important;
        }

        /* --- AKSI BUTTONS --- */
        .aksi-wrapper {
            display: flex;
            flex-direction: column;
            gap: 4px;
            width: 85px;
            margin: 0 auto;
        }

        .btn-aksi-teks {
            width: 100%; padding: 4px 0; border-radius: 6px;
            font-weight: 700; font-size: 0.6rem; border: none;
            transition: all 0.2s; text-transform: uppercase; text-align: center;
        }
        .btn-edit { background: rgba(99, 102, 241, 0.1); color: #6366f1; }
        .btn-mutasi { background: rgba(245, 158, 11, 0.1); color: #d97706; }
        .btn-pensiun { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
        .btn-aksi-teks:hover { transform: translateY(-1px); filter: brightness(0.9); }

        /* --- NOTIFIKASI INDIGO --- */
        .alert-custom-box {
            position: relative; 
            background-color: #6366f1; 
            color: white; padding: 18px 25px; border-radius: 12px;
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 25px; box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
            overflow: hidden;
            animation: slideDownIn 0.4s ease-out;
        }

        .progress-bar-moving {
            position: absolute; bottom: 0; left: 0; height: 4px;
            background: rgba(255, 255, 255, 0.7); width: 100%;
            animation: moveProgress 5s linear forwards;
        }

        @keyframes moveProgress { from { width: 100%; } to { width: 0%; } }
        @keyframes slideDownIn { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* Search Input */
        .input-search-custom {
            width: 320px; padding: 10px 15px 10px 40px; border-radius: 50px; 
            border: 1px solid var(--border-color); background: white; outline: none;
            transition: all 0.3s; font-size: 0.85rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }
        .input-search-custom:focus { 
            border-color: var(--accent-master); 
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); 
        }

        .x-small { font-size: 0.65rem; line-height: 1.2; }

        /* --- STYLING LIST DIKLAT PARAGRAF RAPI --- */
        .list-diklat {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .list-diklat li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 4px;
            text-align: left;
        }
        .list-diklat .num {
            min-width: 18px; 
            font-weight: 600;
            flex-shrink: 0;
        }
        .list-diklat .text {
            flex-grow: 1;
            word-break: break-word;
        }
    </style>
</head>
<body>
    @include('komponen.banner_demo')
    @include('komponen.bilah_samping')

    <main class="konten-utama" id="mainContent">
        {{-- WADAH PENAMPUNG NOTIFIKASI FLOATING --}}
        <div class="notifikasi-floating-wrapper">
            @include('komponen.notifikasi')
        </div>

        <div class="header-atas d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2" style="font-size: 0.75rem;">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted opacity-75">Database Master</a></li>
                        <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: var(--accent-master);">Arsip Pegawai</li>
                    </ol>
                </nav>
                <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -1px;">Data Seluruh Pegawai</h2>
                <p class="text-muted small mb-0 fw-medium">Bapas Kelas II Magelang • Database pusat personil.</p>
            </div>
            <div class="search-wrapper position-relative">
                <i class="bi bi-search" style="position: absolute; left: 15px; top: 11px; color: #94a3b8; z-index: 5;"></i>
                <input type="text" id="searchInput" class="input-search-custom" placeholder="Cari nama atau nip...">
            </div>
        </div>

        @if(session('success'))
        <div class="alert-custom-box" id="successAlert">
            <div class="d-flex align-items-center">
                <i class="bi bi-database-check me-3 fs-4"></i>
                <div>
                    <strong class="d-block">Sinkronisasi Berhasil</strong>
                    <span class="small opacity-90">{{ session('success') }}</span>
                </div>
            </div>
            <div class="progress-bar-moving"></div>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('successAlert');
                if(alert) {
                    alert.style.opacity = '0';
                    alert.style.transition = '0.5s';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 5000);
        </script>
        @endif

        <div class="wadah-tabel animasi-muncul">
            <div class="table-responsive">
                <table class="table table-custom" id="pegawaiTable">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2" class="sticky-col text-start">Nama Lengkap</th>
                            <th rowspan="2">NIP</th>
                            <th colspan="2">Pangkat</th>
                            <th colspan="2">Jabatan</th>
                            <th colspan="2">Masa Kerja</th>
                            <th colspan="3">Diklat</th>
                            <th colspan="3">Pendidikan</th>
                            <th rowspan="2">Tgl Lahir</th>
                            <th rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th>Gol/RUANG</th><th>T.M.T</th>
                            <th>Nama</th><th>T.M.T</th>
                            <th>THN</th><th>BLN</th>
                            <th>Nama</th><th>THN</th><th>Durasi</th>
                            <th>Nama</th><th>THN</th><th>Ijasah</th>
                        </tr>
                    </thead>
                    <tbody id="pegawaiTableBody">
                        <?php if (isset($pegawais) && count($pegawais) > 0): ?>
                            <?php 
                            $index = 0;
                            foreach ($pegawais as $p):$index++;
                                $p->loadMissing('dokumens');$isGuest = Auth::check() && Auth::user()->email === 'guest@demo.com';
                                $isMasterData = !$p->is_demo;
                                
                                $arrDiklatNama = ($p->diklat_nama && $p->diklat_nama !== '-') ? explode('\vert{}', $p->diklat_nama) : [];
                                $arrDiklatTahun = ($p->diklat_tahun && $p->diklat_tahun !== '-') ? explode('\vert{}', $p->diklat_tahun) : [];
                                $arrDiklatDurasi = ($p->diklat_durasi && $p->diklat_durasi !== '-') ? explode('\vert{}', $p->diklat_durasi) : [];
                            ?>
                            <tr class="pegawai-row">
                                <td class="text-center text-muted fw-bold"><?= $index; ?></td>
                                <td class="sticky-col search-name">
                                    <div class="fw-bold text-dark"><?= e($p->nama_lengkap); ?></div>
                                </td>
                                <td class="text-muted font-monospace search-nip text-center"><?= e($p->nip); ?></td>
                                <td class="text-center"><?= e($p->pangkat_golongan ?? '-'); ?></td>
                                <td class="text-center"><?= $p->tmt_pangkat ? \Carbon\Carbon::parse($p->tmt_pangkat)->format('d/m/Y') : '-'; ?></td>
                                <td class="text-center"><?= e($p->jabatan ?? '-'); ?></td>
                                <td class="text-center"><?= $p->tmt_jabatan ? \Carbon\Carbon::parse($p->tmt_jabatan)->format('d/m/Y') : '-'; ?></td>
                                <td class="text-center fw-bold"><?= e($p->mk_tahun ?? '0'); ?></td>
                                <td class="text-center fw-bold"><?= e($p->mk_bulan ?? '0'); ?></td>
                                
                                {{-- KOLOM DIKLAT --}}
                                <td style="min-width: 200px;">
                                    <?php if (count($arrDiklatNama) > 0): ?>
                                        <ul class="list-diklat">
                                            <?php foreach ($arrDiklatNama as $idx =>$item): ?>
                                                <li class="x-small">
                                                    <span class="num"><?= ($idx + 1); ?>.</span>
                                                    <span class="text"><?= e(trim($item)); ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="text-center small">
                                    <?php if (count($arrDiklatTahun) > 0): ?>
                                        <?php foreach ($arrDiklatTahun as$item): ?>
                                            <div class="x-small"><?= e($item); ?></div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="text-center small">
                                    <?php if (count($arrDiklatDurasi) > 0): ?>
                                        <?php foreach ($arrDiklatDurasi as$item): ?>
                                            <div class="x-small"><?= e($item); ?></div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>

                                {{-- KOLOM PENDIDIKAN --}}
                                <td style="min-width: 150px;">
                                    <?php if ($p->pendidikans &&$p->pendidikans->count() > 0): ?>
                                        <ul class="list-diklat">
                                            <?php foreach ($p->pendidikans as $idx =>$pend): ?>
                                                <li class="x-small">
                                                    <span class="num"><?= ($idx + 1); ?>.</span>
                                                    <span class="text"><?= e($pend->pendidikan_nama); ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="text-center small">
                                    <?php if ($p->pendidikans &&$p->pendidikans->count() > 0): ?>
                                        <?php foreach ($p->pendidikans as$pend): ?>
                                            <div class="x-small"><?= e($pend->pendidikan_tahun); ?></div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="text-center small">
                                    <?php if ($p->pendidikans &&$p->pendidikans->count() > 0): ?>
                                        <?php foreach ($p->pendidikans as$pend): ?>
                                            <div class="x-small"><?= e($pend->pendidikan_ijazah); ?></div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>

                                <td class="text-center small fw-medium"><?= $p->tanggal_lahir ? \Carbon\Carbon::parse($p->tanggal_lahir)->format('d/m/Y') : '-'; ?></td>
                                <td class="text-center">
                                    <div class="aksi-wrapper">
                                        {{-- COMPONENT TOMBOL BERKAS --}}
                                        @include('komponen.btn_berkas.btn_berkas', ['p' => $p])

                                        <?php if ($isGuest &&$isMasterData): ?>
                                            {{-- AKSI PROTEKSI KHUSUS GUEST UNTUK DATA MASTER ADMIN --}}
                                            <button type="button" class="btn-aksi-teks btn-edit" onclick="tampilkanPeringatanMasterData()">Edit</button>
                                            <button type="button" class="btn-aksi-teks btn-mutasi" onclick="tampilkanPeringatanMasterData()">Mutasi</button>
                                            <button type="button" class="btn-aksi-teks btn-pensiun" onclick="tampilkanPeringatanMasterData()">Pensiun</button>
                                        <?php else: ?>
                                            {{-- AKSI NORMAL ADMIN / DATA INPUTAN GUEST SENDIRI --}}
                                            <button type="button" class="btn-aksi-teks btn-edit" onclick='bukaModalEdit(<?= json_encode($p->load("pendidikans")); ?>)'>Edit</button>
                                            <button type="button" class="btn-aksi-teks btn-mutasi" onclick='bukaModalMutasi(<?= json_encode($p); ?>)' data-bs-toggle="modal" data-bs-target="#modalKonfirmasiMutasi">Mutasi</button>
                                            <button type="button" class="btn-aksi-teks btn-pensiun" onclick='bukaModalPensiun(<?= json_encode($p); ?>)' data-bs-toggle="modal" data-bs-target="#modalKonfirmasiPensiun">Pensiun</button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="17" class="text-center py-5 text-muted small italic">Data personil belum tersedia.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @include('admin.pegawai.modalpensiunmutasi')
    @include('komponen.modal_dialog')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('.pegawai-row');
            rows.forEach(row => {
                let name = row.querySelector('.search-name').innerText.toLowerCase();
                let nip = row.querySelector('.search-nip').innerText.toLowerCase();
                row.style.display = (name.includes(searchValue) || nip.includes(searchValue)) ? "" : "none";
            });
        });

        function bukaModalMutasi(data) {
            document.getElementById('formActionMutasi').action = "/admin/pegawai/mutasi/" + data.id;
            document.getElementById('text_mutasi_nama').innerText = data.nama_lengkap;
            document.getElementById('text_mutasi_nip').innerText = data.nip || '-';
        }

        function bukaModalPensiun(data) {
            document.getElementById('formActionPensiun').action = "/admin/pegawai/pensiun/" + data.id;
            document.getElementById('text_pensiun_nama').innerText = data.nama_lengkap;
            document.getElementById('text_pensiun_nip').innerText = data.nip || '-';
        }

        function bukaModalEdit(data) {
            const form = document.getElementById('formEditPegawai');
            if(form) form.action = "/admin/pegawai/" + data.id;

            const formatTgl = (str) => (!str) ? '' : str.substring(0, 10);
            
            if(document.getElementById('edit_nama')) document.getElementById('edit_nama').value = data.nama_lengkap || '';
            if(document.getElementById('edit_nip')) document.getElementById('edit_nip').value = data.nip || '';
            if(document.getElementById('edit_tgl_lahir')) document.getElementById('edit_tgl_lahir').value = formatTgl(data.tanggal_lahir);
            if(document.getElementById('edit_tmt_pangkat_monitoring')) document.getElementById('edit_tmt_pangkat_monitoring').value = formatTgl(data.tmt_pangkat_terakhir);
            if(document.getElementById('edit_tmt_kgb')) document.getElementById('edit_tmt_kgb').value = formatTgl(data.tmt_kgb_terakhir);
            if(document.getElementById('edit_golongan')) document.getElementById('edit_golongan').value = data.pangkat_golongan || '';
            if(document.getElementById('edit_tmt_pangkat_master')) document.getElementById('edit_tmt_pangkat_master').value = formatTgl(data.tmt_pangkat);
            if(document.getElementById('edit_jabatan')) document.getElementById('edit_jabatan').value = data.jabatan || '';
            if(document.getElementById('edit_tmt_jabatan')) document.getElementById('edit_tmt_jabatan').value = formatTgl(data.tmt_jabatan);
            if(document.getElementById('edit_mk_tahun')) document.getElementById('edit_mk_tahun').value = data.mk_tahun || 0;
            if(document.getElementById('edit_mk_bulan')) document.getElementById('edit_mk_bulan').value = data.mk_bulan || 0;

            const containerPen = document.getElementById('edit-pendidikan-container');
            if (containerPen) {
                containerPen.innerHTML = ''; 
                if (data.pendidikans && data.pendidikans.length > 0) {
                    data.pendidikans.forEach(pen => {
                        renderBarisPendidikanEdit(containerPen, pen.pendidikan_nama, pen.pendidikan_tahun, pen.pendidikan_ijazah);
                    });
                } else {
                    renderBarisPendidikanEdit(containerPen, '', '', '');
                }
            }

            const dNama = (data.diklat_nama || '').split('|');
            const dTahun = (data.diklat_tahun || '').split('|');
            const dDurasi = (data.diklat_durasi || '').split('|');
            
            const inputNama = document.querySelectorAll('.edit-diklat-nama');
            const inputTahun = document.querySelectorAll('.edit-diklat-tahun');
            const inputDurasi = document.querySelectorAll('.edit-diklat-durasi');

            inputNama.forEach((el, i) => {
                el.value = dNama[i] || '';
                if(inputTahun[i]) inputTahun[i].value = dTahun[i] || '';
                if(inputDurasi[i]) inputDurasi[i].value = dDurasi[i] || '';
            });

            var modalEdit = new bootstrap.Modal(document.getElementById('modalEditPegawai'));
            modalEdit.show();
        }

        function renderBarisPendidikanEdit(container, nama, tahun, ijazah) {
            const div = document.createElement('div');
            div.className = 'row g-2 mb-2 align-items-center pendidikan-item';
            div.innerHTML = `
                <div class="col-5">
                    <input type="text" name="pendidikan_nama[]" class="form-control form-control-sm" value="${nama || ''}" placeholder="Jenjang/Nama">
                </div>
                <div class="col-3">
                    <input type="text" name="pendidikan_tahun[]" class="form-control form-control-sm" value="${tahun || ''}" placeholder="Tahun">
                </div>
                <div class="col-3">
                    <input type="text" name="pendidikan_ijazah[]" class="form-control form-control-sm" value="${ijazah || ''}" placeholder="Ijazah">
                </div>
                <div class="col-1 text-center">
                    <button type="button" class="btn btn-outline-danger btn-sm border-0" onclick="this.closest('.row').remove()">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(div);
        }

        function tambahBarisPendidikanEdit() {
            const container = document.getElementById('edit-pendidikan-container');
            if(container) renderBarisPendidikanEdit(container, '', '', '');
        }

        function tampilkanPeringatanMasterData() {
            const notifLama = document.getElementById('alert-error');
            if (notifLama) {
                notifLama.remove();
            }

            const wrapperNotif = document.querySelector('.notifikasi-floating-wrapper') || document.body;

            const htmlNotif = `
                <div id="alert-error" class="alert-custom-wrapper">
                    <div class="alert-custom-content bg-error">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-white text-danger me-3">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Akses Dibatasi!</h6>
                                    <small>Data ini merupakan Data Master Admin dan bersifat permanen. Sebagai akun Guest, Anda hanya dapat mengubah data yang Anda tambahkan sendiri!</small>
                                </div>
                            </div>
                            <button type="button" class="btn-close-custom" onclick="tutupNotifikasi('alert-error')">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <div class="progress-container">
                            <div id="progress-bar-error" class="progress-bar-fill"></div>
                        </div>
                    </div>
                </div>
            `;

            wrapperNotif.insertAdjacentHTML('afterbegin', htmlNotif);

            const progressBar = document.getElementById('progress-bar-error');
            const duration = 4000;
            let start = Date.now();

            const timer = setInterval(() => {
                let timePassed = Date.now() - start;
                let progress = 100 - (timePassed / duration * 100);
                if (progressBar) progressBar.style.width = progress + '%';
                if (timePassed >= duration) {
                    clearInterval(timer);
                    tutupNotifikasi('alert-error');
                }
            }, 10);
        }

        function toggleRow(id) { return; }
    </script>
</body>
</html>