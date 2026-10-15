<!DOCTYPE html>
<html>
<head><title>Edit Pegawai</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="card col-md-6 mx-auto shadow">
        <div class="card-header bg-warning">Edit Data Pegawai</div>
        <div class="card-body">
            <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-2"><label>NIP</label><input type="text" name="nip" class="form-control" value="{{ $pegawai->nip }}" required></div>
                <div class="mb-2"><label>Nama</label><input type="text" name="nama_lengkap" class="form-control" value="{{ $pegawai->nama_lengkap }}" required></div>
                <div class="mb-2"><label>Jabatan</label><input type="text" name="jabatan" class="form-control" value="{{ $pegawai->jabatan }}"></div>
                <div class="mb-2"><label>Golongan</label><input type="text" name="pangkat_golongan" class="form-control" value="{{ $pegawai->pangkat_golongan }}"></div>
                <div class="row mb-3">
                    <div class="col"><label>TMT Pangkat</label><input type="date" name="tmt_pangkat" class="form-control" value="{{ $pegawai->tmt_pangkat_terakhir ? $pegawai->tmt_pangkat_terakhir->format('Y-m-d') : '' }}"></div>
                    <div class="col"><label>TMT KGB</label><input type="date" name="tmt_kgb" class="form-control" value="{{ $pegawai->tmt_kgb_terakhir ? $pegawai->tmt_kgb_terakhir->format('Y-m-d') : '' }}"></div>
                </div>
                <button class="btn btn-primary w-100">Update Perubahan</button>
                <a href="{{ route('dashboard') }}" class="btn btn-link w-100 text-decoration-none mt-2">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>