<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai Mutasi - SISPEG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --ungu-bapas: #6f42c1; --bg-utama: #f4f7fe; --lebar-samping: 260px; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-utama); margin: 0; }
        .konten-utama { margin-left: var(--lebar-samping); padding: 40px; }
        .wadah-tabel { background: white; padding: 25px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); }
        .table-custom thead th { background-color: #ffc107 !important; color: black !important; text-align: center; }
    </style>
</head>
<body>
    @include('komponen.banner_demo')

    @include('komponen.bilah_samping')

    <main class="konten-utama">
        <div class="mb-4">
            <h3 class="fw-bold text-dark">Daftar Pegawai Mutasi</h3>
            <p class="text-muted small">Daftar personil yang telah pindah tugas / mutasi</p>
        </div>

        <div class="wadah-tabel border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-custom table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA LENGKAP</th>
                            <th>NIP</th>
                            <th>JABATAN TERAKHIR</th>
                            <th>PANGKAT/GOL</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawaiMutasi as $index => $p)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $p->nama_lengkap }}</td>
                            <td>{{ $p->nip }}</td>
                            <td>{{ $p->jabatan }}</td>
                            <td class="text-center">{{ $p->pangkat_golongan }}</td>
                            <td class="text-center"><span class="badge bg-warning text-dark">Mutasi</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-5 text-muted">Belum ada data pegawai mutasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <a href="{{ route('pegawai.data') }}" class="btn btn-sm btn-secondary mt-3"> Kembali ke Master</a>
        </div>
    </main>

</body>
</html>