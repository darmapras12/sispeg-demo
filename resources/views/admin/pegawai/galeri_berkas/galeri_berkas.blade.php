<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berkas {{ $pegawai->nama_lengkap }} - SISPEG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { 
            var(--lebar-samping): 260px;
            var(--lebar-samping-mini): 95px; /* Disamakan 95px agar pas dengan bilah_samping */
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background-color: #f8fafc; 
            color: #334155; 
            margin: 0 !important;
            min-height: 100vh;
        }

        /* --- LOGIKA PENYESUAIAN SIDEBAR (SAMA SEPERTI MASTER) --- */
        .konten-utama { 
            margin-left: var(--lebar-samping); 
            padding: 40px; 
            transition: margin-left 0.6s cubic-bezier(0.23, 1, 0.32, 1); /* Menyesuaikan transisi premium sidebar */
        }

        body.sidebar-is-mini .konten-utama { 
            margin-left: var(--lebar-samping-mini) !important; 
        }

        .card-berkas { border-radius: 12px; border: 1px solid #e2e8f0; transition: all 0.2s; }
        .card-berkas:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    @include('komponen.bilah_samping')

    <main class="konten-utama" id="mainContent">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-4">
            @if(isset($pegawai) && (strtolower($pegawai->status) === 'mutasi' || $pegawai->status === 'Mutasi'))
                <a href="{{ route('mutasi.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
                    <i class="bi bi-arrow-left"></i> Kembali ke Database
                </a>
            @elseif(isset($pegawai) && (strtolower($pegawai->status) === 'pensiun' || $pegawai->status === 'Pensiun'))
                <a href="{{ route('pensiun.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
                    <i class="bi bi-arrow-left"></i> Kembali ke Database
                </a>
            @else
                <a href="{{ route('pegawai.data') }}" class="btn btn-sm btn-outline-secondary mb-3">
                    <i class="bi bi-arrow-left"></i> Kembali ke Database
                </a>
            @endif
            <h2 class="fw-bold text-dark mb-1">Arsip Berkas Digital</h2>
            <p class="text-muted">Pegawai: <strong>{{ $pegawai->nama_lengkap }}</strong> (NIP. {{ $pegawai->nip ?? '-' }})</p>
        </div>

        <div class="row g-3">
        @forelse($pegawai->dokumens as $b)
            <div class="col-md-4">
                <div class="card card-berkas h-100 bg-white p-3">
                    <div class="d-flex align-items-center gap-3">
                        @php
                            // Mengambil ekstensi file dari database dan mengubahnya ke huruf kecil
                            $ekstensi = strtolower(pathinfo($b->path_file, PATHINFO_EXTENSION));
                            $isGambar = in_array($ekstensi, ['jpg', 'jpeg', 'png', 'webp']);
                        @endphp

                        <div class="icon-box bg-light p-3 rounded-3 {{ $isGambar ? 'text-primary' : 'text-danger' }}">
                            @if($isGambar)
                                <i class="bi bi-file-earmark-image fs-3"></i>
                            @else
                                <i class="bi bi-file-pdf fs-3"></i>
                            @endif
                        </div>
                        <div class="overflow-hidden">
                            <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $b->jenis_dokumen }}</h6>
                            <span class="text-muted x-small d-block">Diunggah: {{ \Carbon\Carbon::parse($b->created_at)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <hr class="text-muted opacity-25">
                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ route('dokumen.preview', $b->id) }}" target="_blank" class="btn btn-sm btn-light w-100">
                            <i class="bi bi-eye"></i> Preview
                        </a>
                        <a href="{{ asset($b->path_file) }}" download class="btn btn-sm btn-primary w-100">
                            <i class="bi bi-download"></i> Unduh
                        </a>
                        <form action="{{ route('dokumen.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berkas ini secara permanen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Berkas">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded-4 border border-dashed p-5 text-muted">
                    <i class="bi bi-folder-x fs-1 opacity-50 d-block mb-3"></i>
                    Belum ada berkas digital yang diunggah untuk pegawai ini.
                </div>
            </div>
        @endforelse
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sinkronisasi Kondisi Awal Saat Halaman Pertama Kali Dimuat
        if (localStorage.getItem('sidebarStatus') === 'mini') {
            document.body.classList.add('sidebar-is-mini');
        }

        // MutationObserver untuk mendeteksi perubahan class di tag <html> secara real-time
        // agar halaman Arsip Berkas ikut bergeser saat tombol sidebar di-klik
        const observer = new MutationObserver(() => {
            const isMini = document.documentElement.classList.contains('sidebar-is-mini');
            document.body.classList.toggle('sidebar-is-mini', isMini);
        });

        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
    </script>
</body>
</html>