<!DOCTYPE html>
<html>
<head><title>Tambah Pegawai</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="card col-md-6 mx-auto shadow">
        <div class="card-header bg-primary text-white">Tambah Pegawai Baru</div>
        <div class="card-body">
            <form action="{{ route('pegawai.store') }}" method="POST">
                @csrf
                <div class="mb-2"><label>NIP</label><input type="text" name="nip" class="form-control" required></div>
                <div class="mb-2"><label>Nama Lengkap</label><input type="text" name="nama_lengkap" class="form-control" required></div>
                <div class="mb-2"><label>Jabatan</label><input type="text" name="jabatan" class="form-control"></div>
                <div class="mb-2"><label>Golongan</label><input type="text" name="pangkat_golongan" class="form-control"></div>
                <div class="row mb-3">
                    <div class="col"><label>TMT Pangkat Terakhir</label><input type="date" name="tmt_pangkat" class="form-control" required></div>
                    <div class="col"><label>TMT KGB Terakhir</label><input type="date" name="tmt_kgb" class="form-control" required></div>
                </div>
                <button class="btn btn-primary w-100">Simpan Data</button>
                <a href="{{ route('dashboard') }}" class="btn btn-link w-100 text-decoration-none mt-2">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>