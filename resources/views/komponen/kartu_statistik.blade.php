<style>
    .kartu-stat { background: white; padding: 25px; border-radius: 20px; border-left: 5px solid; cursor: pointer; transition: 0.3s; position: relative; overflow: hidden; }
    .kartu-stat:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .ikon-hiasan { position: absolute; right: -10px; bottom: -10px; font-size: 4rem; opacity: 0.05; transform: rotate(-15deg); }
</style>

<div class="row g-4 mb-5">
    {{-- Kartu Total Pegawai --}}
    <div class="col-12 col-md-4">
        <div class="kartu-stat border-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTotalPegawai">
            <h6 class="text-muted small fw-bold text-uppercase">TOTAL PEGAWAI</h6>
            <h2 class="fw-bold m-0 text-primary">{{ $totalPegawai }}</h2>
            <p class="text-muted small mb-0 mt-2">Pegawai terdaftar di database</p>
            <i class="bi bi-people ikon-hiasan"></i>
        </div>
    </div>

    {{-- Kartu Estimasi KP --}}
    <div class="col-12 col-md-4">
        <div class="kartu-stat border-warning shadow-sm" data-bs-toggle="modal" data-bs-target="#modalEstimasiKP">
            <h6 class="text-muted small fw-bold text-uppercase">ESTIMASI KP</h6>
            <h2 class="fw-bold m-0 text-warning">{{ $akanKP }}</h2>
            <p class="text-muted small mb-0 mt-2">
                Pegawai memiliki jadwal KP
            </p>
            <i class="bi bi-graph-up-arrow ikon-hiasan"></i>
        </div>
    </div>

    {{-- Kartu Estimasi KGB --}}
    <div class="col-12 col-md-4">
        <div class="kartu-stat border-success shadow-sm" data-bs-toggle="modal" data-bs-target="#modalEstimasiKGB">
            <h6 class="text-muted small fw-bold text-uppercase">ESTIMASI KGB</h6>
            <h2 class="fw-bold m-0 text-success">{{ $akanKGB }}</h2>
            <p class="text-muted small mb-0 mt-2">Pegawai memiliki jadwal KGB</p>
            <i class="bi bi-wallet2 ikon-hiasan"></i>
        </div>
    </div>
</div>