<!DOCTYPE html>
<html>
<head><title>Cek KP & KGB</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white d-flex align-items-center justify-content-center" style="height:100vh">
    <div class="card shadow p-4 border-0" style="width: 500px; border-radius: 15px;">
        <h3 class="text-center mb-2 fw-bold text-primary">SISPEG</h3>
        <p class="text-center text-muted mb-4">Cek Jadwal Kenaikan Pangkat & Gaji</p>
        
        <form action="{{ route('cek.cari') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="nip" class="form-control form-control-lg" placeholder="Masukkan NIP..." required>
                <button class="btn btn-primary btn-lg">Cari</button>
            </div>
        </form>

        @if(session('error')) <div class="alert alert-danger text-center">{{ session('error') }}</div> @endif
        
        @if(session('hasil'))
            @php $p = session('hasil'); @endphp
            <div class="alert alert-info mt-3 shadow-sm">
                <h5 class="fw-bold mb-1">{{ $p->nama_lengkap }}</h5>
                <p class="mb-2 small">{{ $p->jabatan }} | Gol: {{ $p->pangkat_golongan }}</p>
                <hr>
                <div class="row text-center">
                    <div class="col">
                        <small>KP Berikutnya:</small><br>
                        <strong class="text-primary">{{ $p->next_kp ? $p->next_kp->format('d-m-Y') : '-' }}</strong>
                    </div>
                    <div class="col">
                        <small>KGB Berikutnya:</small><br>
                        <strong class="text-success">{{ $p->next_kgb ? $p->next_kgb->format('d-m-Y') : '-' }}</strong>
                    </div>
                </div>
            </div>
        @endif
        <div class="text-center mt-4"><a href="{{ route('dashboard') }}" class="small text-muted text-decoration-none">Login Admin &rarr;</a></div>
    </div>
</body>
</html>