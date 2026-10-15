<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Monitoring - SISPEG</title>
    
    <link rel="icon" type="image/png" href="{{ asset('img/ikon.png') }}">
    
    <script>
        (function() {
            if (localStorage.getItem('sidebarStatus') === 'mini') {
                document.documentElement.classList.add('sidebar-is-mini');
            }
        })();
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --bg-utama: #ffffff; 
            --warna-aksen: #0d9488; 
            --lebar-samping: 260px; 
            --lebar-samping-mini: 80px;
            --transisi-halus: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            min-height: 100vh;
            background-color: #f8fafc;
            color: #1e293b; 
            overflow-x: hidden; 
        }

        .konten-utama { 
            margin-left: var(--lebar-samping); 
            padding: 0 0 25px 25px; 
            transition: var(--transisi-halus); 
            min-height: 100vh;
            width: calc(100% - var(--lebar-samping));
            position: relative; 
        }

        .sidebar-is-mini .konten-utama { 
            margin-left: var(--lebar-samping-mini) !important; 
            width: calc(100% - var(--lebar-samping-mini));
        }

        .table-hover-custom .table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-accent-bg: transparent !important;
            box-shadow: none !important;
        }

        .table-hover-custom table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table-hover-custom table tbody tr:hover td,
        .table-hover-custom table tbody tr:hover th {
            background-color: #e0f2fe !important; 
            background-image: none !important;
            color: #1e293b !important;
            cursor: pointer;
            box-shadow: none !important;
        }

        .table-hover-custom table tbody tr:hover td:first-child,
        .table-hover-custom table tbody tr:hover th:first-child {
            box-shadow: inset 6px 0 0 #3b82f6 !important;
        }

        .table-hover-custom table tbody tr:hover td {
            border-bottom: 1px solid #bae6fd !important;
        }

        .notifikasi-floating-wrapper {
            position: absolute; 
            left: 25px;
            right: 50px;
            z-index: 1050; 
            pointer-events: none; 
        }
        
        .notifikasi-floating-wrapper > * {
            pointer-events: auto; 
        }

        .hero-banner-box {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            border-bottom-left-radius: 60px; 
            padding: 20px 40px 75px 40px; 
            position: relative;
            margin-bottom: 40px;
            box-shadow: 0 20px 30px rgba(37, 99, 235, 0.15);
            width: 100%;
            overflow: visible;
        }

        .hero-banner-box::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background-image: url('https://img.freepik.com/free-vector/gradient-dynamic-blue-lines-background_23-2148995756.jpg');
            background-size: cover;
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
        }

        .hero-flex-wrapper {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            position: relative;
            z-index: 2;
            gap: 20px;
        }

        .hero-content { color: white; flex: 1; max-width: 600px; padding-top: 15px; }
        .foto-admin-container { flex: 1; display: flex; justify-content: center; align-items: flex-start; position: relative; }
        .foto-admin-bg {
            height: 320px;
            width: auto;
            object-fit: contain;
            margin-top: -70px;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.2));
            z-index: 101;
            animation: fadeInRight 1s ease-out;
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .stats-overlap {
            position: absolute;
            bottom: -35px; 
            left: 30px;
            right: 30px;
            z-index: 5; 
        }

        .card-stat { 
            position: relative;
            border-radius: 22px; 
            border: none;
            padding: 24px;
            transition: var(--transisi-halus);
            cursor: pointer;
            color: white;
            min-height: 140px;
            box-shadow: 0 12px 25px rgba(0,0,0,0.25);
        }

        .card-stat:hover { transform: translateY(-8px); }
        .stat-total { background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); }
        .stat-kp { background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); }
        .stat-kgb { background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); }
        .card-active { outline: 4px solid white; outline-offset: -8px; }

        .icon-shape {
            width: 52px; height: 52px; background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px); border-radius: 15px; display: flex;
            align-items: center; justify-content: center; font-size: 1.7rem;
            margin-bottom: 12px;
        }

        .wadah-angka-rolling { display: inline-flex; overflow: hidden; height: 38px; line-height: 38px; vertical-align: bottom; }
        .kolom-angka-rolling { display: flex; flex-direction: column; transition: transform 1.8s cubic-bezier(0.23, 1, 0.32, 1); }
        .kolom-angka-rolling span { height: 38px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 2rem; }

        /* Container Pembungkus Baris Tombol Aksi */
        .area-tombol-kanan-atas {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            padding-right: 25px;
            margin-top: 100px;
            margin-bottom: 25px;
        }

        .btn-export-custom {
            background-color: #ffffff !important;
            color: #158754 !important;
            border: 1px solid #158754 !important;
            padding: 10px 24px;
            border-radius: 20px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .btn-export-custom:hover {
            background-color: #f0fdf4 !important;
        }

        .btn-tambah-custom {
            background-color: #0d9488 !important;
            color: #ffffff !important;
            border: none !important;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.15);
        }

        .btn-tambah-custom:hover {
            background-color: #0f766e !important;
        }

        .btn-berkas-custom {
            background-color: #158754 !important;
            color: #ffffff !important;
            border: none !important;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(21, 135, 84, 0.15);
        }

        .btn-berkas-custom:hover {
            background-color: #116941 !important;
        }

        .wadah-tabel { 
            background: white; 
            border-radius: 16px; 
            border: 1px solid #e2e8f0; 
            overflow: hidden; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            margin-right: 25px; 
            margin-top: 10px;
        }

        .animasi-muncul { animation: fadeInUp 0.5s ease forwards; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        @media (max-width: 991.98px) { 
            .konten-utama { margin-left: 0 !important; width: 100% !important; padding: 0 0 15px 0; }
            .hero-banner-box { padding: 20px 20px 140px 20px; border-bottom-left-radius: 40px; }
            .stats-overlap { bottom: -80px; left: 15px; right: 15px; }
            .area-tombol-kanan-atas { margin-top: 140px; flex-wrap: wrap; justify-content: flex-start; padding-left: 15px; }
        }
    </style>
</head>
<body>
    {{-- Banner Notifikasi Mode Guest --}}
    @if(Auth::check() && Auth::user()->email === 'guest@demo.com')
    <div class="alert alert-warning border-0 shadow-sm rounded-0 m-0 py-2 text-center fw-medium" style="background-color: #fef3c7; color: #92400e; position: sticky; top: 0; z-index: 2000; font-size: 13px;">
        <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>
        <strong>Informasi Akun Demo:</strong> Anda sedang login menggunakan akun <u>Guest Demo</u>. Silakan mencoba menginputkan data untuk menguji sistem SISPEG. Data yang di-inputkan tidak tersimpan secara permanen dan akan terhapus otomatis saat sesi demo berikutnya dimulai.
    </div>
    @endif
    
    @include('komponen.bilah_samping')

    <main class="konten-utama" id="kontenUtama">
        <div class="hero-banner-box animasi-muncul">
            <div class="hero-flex-wrapper">
                <div class="hero-content">
                    <div class="d-flex align-items-center gap-2 mb-2" style="font-size: 13px; opacity: 0.85;">
                        <span>Admin</span> <i class="bi bi-chevron-right" style="font-size: 10px;"></i> <span class="fw-medium text-white">Dashboard Monitoring</span>
                    </div>
                    <h1 class="fw-bold mb-2" style="font-size: 38px; letter-spacing: -1.5px;">Monitoring Dashboard</h1>
                    <p class="mb-3" style="font-size: 16px; opacity: 0.9;">Kelola kenaikan pangkat dan gaji berkala secara efisien.</p>
                </div>

                <div class="foto-admin-container">
                    <img src="{{ asset('img/admin.png') }}" class="foto-admin-bg" alt="Admin Illustration">
                </div>
            </div>

            <div class="stats-overlap">
                <div class="row g-4">
                    <div class="col-md-4" onclick="filterTabel('total')">
                        <div class="card-stat stat-total {{ $tipeAktif == 'total' ? 'card-active' : '' }}" id="stat-total">
                            <div class="icon-shape"><i class="bi bi-person-badge-fill"></i></div>
                            <p class="mb-1 small fw-medium text-white-50 text-uppercase">Total Pegawai</p>
                            <h3 class="fw-bold mb-0 wadah-angka-rolling" data-nilai="{{ $semuaPegawai->count() }}"></h3>
                        </div>
                    </div>
                    <div class="col-md-4" onclick="filterTabel('kp')">
                        <div class="card-stat stat-kp {{ $tipeAktif == 'kp' ? 'card-active' : '' }}" id="stat-kp">
                            <div class="icon-shape"><i class="bi bi-arrow-up-right-circle-fill"></i></div>
                            <p class="mb-1 small fw-medium text-white-50 text-uppercase">Jadwal KP</p>
                            <h3 class="fw-bold mb-0 wadah-angka-rolling" data-nilai="{{ $pegawaiKP->count() }}"></h3>
                        </div>
                    </div>
                    <div class="col-md-4" onclick="filterTabel('kgb')">
                        <div class="card-stat stat-kgb {{ $tipeAktif == 'kgb' ? 'card-active' : '' }}" id="stat-kgb">
                            <div class="icon-shape"><i class="bi bi-cash-stack"></i></div>
                            <p class="mb-1 small fw-medium text-white-50 text-uppercase">Jadwal KGB</p>
                            <h3 class="fw-bold mb-0 wadah-angka-rolling" data-nilai="{{ $pegawaiKGB->count() }}"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="notifikasi-floating-wrapper animasi-muncul">
            @include('komponen.notifikasi')
        </div>

        <div class="area-tombol-kanan-atas animasi-muncul">
            <a href="{{ route('pegawai.export') }}?tab={{ $tipeAktif }}" id="btnExportExcel" class="btn-export-custom">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>

            <button type="button" class="btn-tambah-custom" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">
                <i class="bi bi-plus-lg"></i> Tambah Pegawai
            </button>

            <button type="button" class="btn-berkas-custom" onclick="bukaModalUpBerkas()">
                <i class="bi bi-file-earmark-plus-fill"></i> + Berkas
            </button>
        </div>

        <div class="wadah-tabel animasi-muncul p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <h5 class="fw-bold mb-0" id="judul-tabel" style="font-size: 18px; color: #0f172a;">
                    <i class="bi bi-table me-2 text-primary"></i>Daftar Seluruh Pegawai
                </h5>
                
                <div class="d-flex align-items-center gap-3">
                    <div id="btnHapusMassalWrapper" style="display: {{ $tipeAktif == 'total' ? 'block' : 'none' }};">
                        <form action="/admin/pegawai/bulk-delete" method="POST" id="formBulkDelete" onsubmit="return persiapkanHapusMassal(event)">
                            @csrf
                            @method('DELETE')
                            <div id="containerIdsHapus"></div>
                            <button type="submit" id="btnBulkDelete" class="btn btn-danger btn-sm fw-medium rounded-pill px-3" disabled>
                                <i class="bi bi-trash3-fill me-1"></i> Hapus Terpilih
                            </button>
                        </form>
                    </div>

                    <div class="position-relative" style="width: 260px;">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="font-size: 14px;"></i>
                        <input type="text" id="inputCari" onkeyup="fiturCari()" class="form-control form-control-sm rounded-pill border-light bg-light ps-5 py-2" placeholder="Cari data..." style="font-size: 13px; box-shadow: inset 0 1px 2px rgba(0,0,0,0.02);">
                    </div>
                </div>
            </div>

            <div id="konten-tabel-dinamis" class="table-responsive table-hover-custom">
                {!! view('komponen.tabel_monitoring', ['data' => ${$tipeAktif == 'total' ? 'semuaPegawai' : ($tipeAktif == 'kp' ? 'pegawaiKP' : 'pegawaiKGB')}, 'tipe' =>$tipeAktif])->render() !!}
            </div>
        </div>
    </main>

    @include('komponen.modal_dialog')
    
    @include('komponen.up_berkas.up_berkas')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function bukaModalUpBerkas() {
            const modalBox = document.querySelector('.modal[id*="berkas" i]') || 
                             document.querySelector('.modal[id*="upload" i]') || 
                             document.querySelector('.modal');
                             
            if (modalBox) {
                const modalInstance = bootstrap.Modal.getInstance(modalBox) || new bootstrap.Modal(modalBox);
                modalInstance.show();
            } else {
                alert('Gagal menampilkan modal. Pastikan struktur modal di file up_berkas.blade.php sudah benar.');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const tombolKeluar = Array.from(document.querySelectorAll('a, button, li')).find(el => {
                const text = el.innerText.toLowerCase();
                return text.includes('keluar') || text.includes('logout') || (el.getAttribute('href') && el.getAttribute('href').includes('logout'));
            });

            if (tombolKeluar) {
                tombolKeluar.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Apakah Anda yakin ingin keluar dari sistem?')) {
                        const formLogout = document.createElement('form');
                        formLogout.method = 'POST';
                        formLogout.action = "{{ route('logout') }}";
                        
                        const tokenCsrf = document.createElement('input');
                        tokenCsrf.type = 'hidden';
                        tokenCsrf.name = '_token';
                        tokenCsrf.value = "{{ csrf_token() }}";
                        
                        formLogout.appendChild(tokenCsrf);
                        document.body.appendChild(formLogout);
                        formLogout.submit();
                    }
                });
            }
        });

        let currentTab = "{{ $tipeAktif }}";
        const dataHTML = {
            total: {!! json_encode(view('komponen.tabel_monitoring', ['data' => $semuaPegawai, 'tipe' => 'total'])->render()) !!},
            kp: {!! json_encode(view('komponen.tabel_monitoring', ['data' => $pegawaiKP, 'tipe' => 'kp'])->render()) !!},
            kgb: {!! json_encode(view('komponen.tabel_monitoring', ['data' => $pegawaiKGB, 'tipe' => 'kgb'])->render()) !!}
        };

        function renderBarisPendidikanEdit(nama = '', tahun = '', ijazah = '') {
            const container = document.getElementById('edit-pendidikan-container');
            if(!container) return;
            const rowId = 'row-' + Date.now() + Math.random().toString(36).substr(2, 9);
            const div = document.createElement('div');
            div.id = rowId;
            div.className = 'd-flex align-items-center gap-2 mb-2';
            div.innerHTML = `
                <input type="text" name="pendidikan_nama[]" class="form-control form-control-sm rounded bg-light border-0 shadow-sm edit-pendidikan-nama" placeholder="Nama" value="${nama}" style="flex: 2;">
                <input type="text" name="pendidikan_tahun[]" class="form-control form-control-sm rounded bg-light border-0 shadow-sm edit-pendidikan-tahun" placeholder="Thn" value="${tahun}" style="flex: 0.8;">
                <input type="text" name="pendidikan_ijazah[]" class="form-control form-control-sm rounded bg-light border-0 shadow-sm edit-pendidikan-ijazah" placeholder="Ijazah" value="${ijazah}" style="flex: 1.2;">
                <button type="button" class="btn btn-sm text-danger p-0" onclick="document.getElementById('${rowId}').remove()">
                    <i class="bi bi-trash"></i>
                </button>
            `;
            container.appendChild(div);
        }

        function bukaModalEdit(data) {
            const form = document.getElementById('formEditPegawai');
            if(form) form.action = `/admin/pegawai/${data.id}`;
            const formatTgl = (str) => (str && str.length >= 10) ? str.substring(0, 10) : '';

            document.getElementById('edit_nama').value = data.nama_lengkap || '';
            document.getElementById('edit_nip').value = data.nip || '';
            document.getElementById('edit_tgl_lahir').value = formatTgl(data.tanggal_lahir);
            document.getElementById('edit_tmt_pangkat_monitoring').value = formatTgl(data.tmt_pangkat_terakhir);
            document.getElementById('edit_tmt_kgb').value = formatTgl(data.tmt_kgb_terakhir);
            document.getElementById('edit_golongan').value = data.pangkat_golongan || '';
            document.getElementById('edit_tmt_pangkat_master').value = formatTgl(data.tmt_pangkat);
            document.getElementById('edit_jabatan').value = data.jabatan || '';
            document.getElementById('edit_tmt_jabatan').value = formatTgl(data.tmt_jabatan);
            document.getElementById('edit_mk_tahun').value = data.mk_tahun || 0;
            document.getElementById('edit_mk_bulan').value = data.mk_bulan || 0;
            
            // --- POPULASI RIWAYAT PENDIDIKAN DENGAN BERBAGAI KEMUNGKINAN FORMAT ---
            const container = document.getElementById('edit-pendidikan-container');
            if (container) {
                container.innerHTML = '';
                
                if (data.pendidikans && data.pendidikans.length > 0) {
                    data.pendidikans.forEach(pen => {
                        renderBarisPendidikanEdit(
                            pen.nama_pendidikan || pen.pendidikan_nama || pen.jenjang || '',
                            pen.tahun_lulus || pen.pendidikan_tahun || pen.tahun || '',
                            pen.no_ijazah || pen.pendidikan_ijazah || pen.ijazah || ''
                        );
                    });
                } else if (Array.isArray(data.pendidikan_nama)) {
                    data.pendidikan_nama.forEach((nama, i) => {
                        renderBarisPendidikanEdit(
                            nama || '',
                            (Array.isArray(data.pendidikan_tahun) ? data.pendidikan_tahun[i] : data.pendidikan_tahun) || '',
                            (Array.isArray(data.pendidikan_ijazah) ? data.pendidikan_ijazah[i] : data.pendidikan_ijazah) || ''
                        );
                    });
                } else if (data.pendidikan_nama && typeof data.pendidikan_nama === 'string') {
                    const pNama = data.pendidikan_nama.split('|');
                    const pTahun = (data.pendidikan_tahun || '').toString().split('|');
                    const pIjazah = (data.pendidikan_ijazah || '').toString().split('|');
                    
                    pNama.forEach((nama, i) => {
                        renderBarisPendidikanEdit(nama || '', pTahun[i] || '', pIjazah[i] || '');
                    });
                } else {
                    renderBarisPendidikanEdit('', '', '');
                }
            } else {
                // Fallback jika menggunakan input biasa tanpa container dinamis
                let pNama = '', pTahun = '', pIjazah = '';
                if (data.pendidikans && data.pendidikans.length > 0) {
                    pNama = data.pendidikans[0].nama_pendidikan || data.pendidikans[0].pendidikan_nama || data.pendidikans[0].jenjang || '';
                    pTahun = data.pendidikans[0].tahun_lulus || data.pendidikans[0].pendidikan_tahun || '';
                    pIjazah = data.pendidikans[0].no_ijazah || data.pendidikans[0].pendidikan_ijazah || '';
                } else {
                    pNama = (data.pendidikan_nama || '').split('|')[0] || '';
                    pTahun = (data.pendidikan_tahun || '').toString().split('|')[0] || '';
                    pIjazah = (data.pendidikan_ijazah || '').toString().split('|')[0] || '';
                }

                const elNama = document.getElementById('edit_pendidikan_nama');
                const elTahun = document.getElementById('edit_pendidikan_tahun');
                const elIjazah = document.getElementById('edit_pendidikan_ijazah');

                if (elNama) elNama.value = pNama;
                if (elTahun) elTahun.value = pTahun;
                if (elIjazah) elIjazah.value = pIjazah;
            }

            // --- POPULASI DIKLAT ---
            const dNama = (data.diklat_nama || '').split('|');
            const dTahun = (data.diklat_tahun || '').split('|');
            const dDurasi = (data.diklat_durasi || '').split('|');
            document.querySelectorAll('.edit-diklat-nama').forEach((input, i) => {
                input.value = dNama[i] || '';
                if(document.querySelectorAll('.edit-diklat-tahun')[i]) document.querySelectorAll('.edit-diklat-tahun')[i].value = dTahun[i] || '';
                if(document.querySelectorAll('.edit-diklat-durasi')[i]) document.querySelectorAll('.edit-diklat-durasi')[i].value = dDurasi[i] || '';
            });

            new bootstrap.Modal(document.getElementById('modalEditPegawai')).show();
        }

        document.addEventListener('click', function(e) {
            const renewBtn = e.target.closest('.btn-renew-action');
            if (renewBtn) {
                e.preventDefault();
                const id = renewBtn.getAttribute('data-id');
                const tipe = renewBtn.getAttribute('data-tipe');
                if (confirm(`Apakah Anda yakin ingin memperbarui jadwal ${tipe.toUpperCase()} untuk pegawai ini?`)) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/pegawai/renew/${id}/${tipe}`;
                    const csrf = document.createElement('input');
                    csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}';
                    const tabInput = document.createElement('input');
                    tabInput.type = 'hidden'; tabInput.name = 'tab_target'; tabInput.value = currentTab;
                    form.appendChild(csrf);
                    form.appendChild(tabInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        });

        function inisialisasiRollingAngka() {
            const containers = document.querySelectorAll('.wadah-angka-rolling');
            containers.forEach(container => {
                const nilai = container.getAttribute('data-nilai') || "0";
                container.innerHTML = '';
                [...nilai.toString()].forEach(digit => {
                    const kolom = document.createElement('div');
                    kolom.className = 'kolom-angka-rolling';
                    for (let i = 0; i <= 9; i++) {
                        const span = document.createElement('span');
                        span.innerText = i;
                        kolom.appendChild(span);
                    }
                    container.appendChild(kolom);
                    setTimeout(() => {
                        kolom.style.transform = `translateY(-${parseInt(digit) * 38}px)`;
                    }, 150);
                });
            });
        }

        function filterTabel(tipe) {
            currentTab = tipe;
            const container = document.getElementById('konten-tabel-dinamis');
            container.innerHTML = dataHTML[tipe];
            document.getElementById('btnHapusMassalWrapper').style.display = (tipe === 'total') ? 'block' : 'none';
            document.getElementById('btnExportExcel').href = `{{ route('pegawai.export') }}?tab=${tipe}`;
            document.querySelectorAll('.card-stat').forEach(c => c.classList.remove('card-active'));
            document.getElementById('stat-' + tipe).classList.add('card-active');
            const judul = { total: "Seluruh Pegawai", kp: "Mendekati Waktu KP", kgb: "Mendekati Waktu KGB" };
            document.getElementById('judul-tabel').innerHTML = `<i class="bi bi-table me-2 text-primary"></i>Daftar ${judul[tipe]}`;
            updateAllCountdowns();
            initCheckboxListeners();
            updateBulkDeleteButton();
            window.history.replaceState(null, null, `?tab=${tipe}`);
            inisialisasiRollingAngka();
        }

        function initCheckboxListeners() {
            const checkAll = document.getElementById('checkAll');
            if(checkAll) {
                checkAll.addEventListener('change', function() {
                    document.querySelectorAll('.check-item').forEach(cb => cb.checked = this.checked);
                    updateBulkDeleteButton();
                });
            }
            document.querySelectorAll('.check-item').forEach(item => {
                item.addEventListener('change', updateBulkDeleteButton);
            });
        }

        function updateBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.check-item:checked');
            const btnHapus = document.getElementById('btnBulkDelete');
            if (btnHapus) btnHapus.disabled = (checkedBoxes.length === 0);
        }

        // --- PENANGANAN SUBMIT HAPUS MASSAL SECARA TERJAMIN ---
        function persiapkanHapusMassal(event) {
            const checkedBoxes = document.querySelectorAll('.check-item:checked');
            if (checkedBoxes.length === 0) {
                event.preventDefault();
                alert('Pilih minimal satu data pegawai untuk dihapus!');
                return false;
            }

            if (!confirm('Apakah Anda yakin ingin menghapus data pegawai yang dipilih?')) {
                event.preventDefault();
                return false;
            }

            const container = document.getElementById('containerIdsHapus');
            container.innerHTML = '';

            checkedBoxes.forEach(cb => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'ids[]';
                hiddenInput.value = cb.value;
                container.appendChild(hiddenInput);
            });

            return true;
        }

        function updateAllCountdowns() {
            document.querySelectorAll('.countdown-timer').forEach(timer => {
                const targetStr = timer.getAttribute('data-time');
                if (!targetStr) return;
                const targetTime = new Date(targetStr).getTime();
                const now = new Date().getTime();
                const diff = targetTime - now;
                if (diff <= 0) {
                    timer.innerHTML = `<span class="badge ${timer.getAttribute('data-jenis') === 'kp' ? 'bg-danger' : 'bg-warning text-dark'}">WAKTUNYA TIBA</span>`;
                    return;
                }
                const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((diff % (1000 * 60)) / 1000);
                timer.innerText = `${d}h ${h}j ${m}m ${s}s`;
            });
        }

        setInterval(updateAllCountdowns, 1000);
        window.onload = function() {
            updateAllCountdowns();
            initCheckboxListeners();
            inisialisasiRollingAngka();
        };

        function fiturCari() {
            let input = document.getElementById("inputCari").value.toLowerCase();
            document.querySelectorAll("tbody tr").forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(input) ? "" : "none";
            });
        }
    </script>
</body>
</html>