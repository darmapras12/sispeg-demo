<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satyalancana - SISPEG</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --primary-slate: #1e293b; 
            --accent-master: #6366f1; 
            --border-color: #e2e8f0;
            --lebar-samping: 260px;
            --lebar-samping-mini: 80px;
        }

        /* --- BACKGROUND TITIK-TITIK ABU + GRADASI TIPIS --- */
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif !important; 
            margin: 0 !important; 
            min-height: 100vh;
            background-color: #ffffff;
            background-image: 
                radial-gradient(#cbd5e1 0.8px, transparent 0.8px), 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 40%), 
                radial-gradient(at 100% 100%, rgba(148, 163, 184, 0.05) 0px, transparent 40%),
                linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            background-size: 30px 30px, 100% 100%, 100% 100%, 100% 100%;
            background-attachment: fixed;
            color: #1e293b;
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

        /* SEARCH BAR STYLE */
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

        /* --- WADAH TABEL MELENGKUNG --- */
        .wadah-tabel { 
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(8px);
            border-radius: 20px !important; 
            box-shadow: 
                0 10px 15px -3px rgba(0, 0, 0, 0.03), 
                0 20px 40px -10px rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            margin-top: 24px !important;
            overflow: hidden;
        }

        /* --- TABLE STYLE --- */
        .table-custom { 
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
            background-color: #f8fafc !important; 
            border-bottom: 2px solid var(--border-color) !important;
            font-size: 0.75rem !important;
        }

        .table-custom tbody td { 
            padding: 15px !important; 
            border-bottom: 1px solid var(--border-color) !important;
            font-size: 0.85rem !important;
            background: transparent !important;
            transition: all 0.2s ease;
        }

        /* --- LOGIKA HOVER SESUAI GAMBAR (INDIGO BORDER LEFT) --- */
        .table-custom tbody tr:hover td {
            background-color: #f5f3ff !important; 
            border-top: 1px solid var(--accent-master) !important;
            border-bottom: 1px solid var(--accent-master) !important;
        }

        .table-custom tbody tr:hover td:first-child {
            border-left: 3px solid var(--accent-master) !important;
        }

        /* --- BADGE MEDALI --- */
        .badge-emas { background: linear-gradient(135deg, #FFD700, #DAA520); color: #000; font-weight: 700; }
        .badge-perak { background: linear-gradient(135deg, #C0C0C0, #A9A9A9); color: #000; font-weight: 700; }
        .badge-perunggu { background: linear-gradient(135deg, #CD7F32, #8B4513); color: #fff; font-weight: 700; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animasi-muncul { animation: fadeInUp 0.7s ease-out forwards; }
    </style>
</head>
<body>

    @include('komponen.banner_demo')

    @include('komponen.bilah_samping')

    <main class="konten-utama">
        <div class="header-atas d-flex justify-content-between align-items-center mb-4 animasi-muncul">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2" style="font-size: 0.75rem;">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted opacity-75">Monitoring</a></li>
                        <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: var(--accent-master);">Satyalancana</li>
                    </ol>
                </nav>
                <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -1px;">Pengecekan Satyalancana</h2>
                <p class="text-muted small fw-medium"></p>
            </div>
            
            <div class="search-wrapper position-relative">
                <i class="bi bi-search" style="position: absolute; left: 15px; top: 11px; color: #94a3b8; z-index: 5;"></i>
                <input type="text" id="searchInput" class="input-search-custom" placeholder="Cari nama atau nip...">
            </div>
        </div>

        <div class="wadah-tabel animasi-muncul">
            <div class="table-responsive">
                <table class="table table-custom align-middle table-hover" id="pegawaiTable">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th class="text-start">Nama Pegawai</th>
                            <th>NIP</th>
                            <th>Masa Kerja</th>
                            <th>Kelayakan</th>
                        </tr>
                    </thead>
                    <tbody id="pegawaiTableBody">
                        @foreach($dataSatya as $row)
                        <tr class="pegawai-row">
                            <td class="text-center text-muted fw-bold">{{ $loop->iteration }}</td>
                            <td class="search-name">
                                <div class="fw-bold text-dark">{{ $row->pegawai->nama_lengkap }}</div>
                            </td>
                            <td class="text-center text-muted font-monospace search-nip">{{ $row->pegawai->nip }}</td>
                            <td class="text-center fw-medium">{{ $row->masa_kerja }}</td>
                            <td style="width: 250px;">
                                <span class="badge p-2 w-100 {{ $row->class }} rounded-pill shadow-sm">
                                    <i class="bi bi-award-fill me-1"></i> {{ $row->status_kelayakan }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // FUNGSI PENCARIAN REAL-TIME
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('.pegawai-row');
            
            rows.forEach(row => {
                let name = row.querySelector('.search-name').innerText.toLowerCase();
                let nip = row.querySelector('.search-nip').innerText.toLowerCase();
                
                if (name.includes(searchValue) || nip.includes(searchValue)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>