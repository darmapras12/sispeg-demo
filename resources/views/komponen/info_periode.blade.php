@php
    use Carbon\Carbon;

    // Menentukan bulan dan tahun aktif dari controller
    $blnInfo = $bulan ?? date('m');
    $thnInfo = $tahun ?? date('Y');

    // Membuat objek Carbon
    $tanggalObj = Carbon::create($thnInfo, $blnInfo, 1);
    
    // Variabel ini akan otomatis tersedia di file yang di-include setelahnya
    $awalBulan = $tanggalObj->copy()->startOfMonth()->translatedFormat('d/m/Y');
    $akhirBulan = $tanggalObj->copy()->endOfMonth()->translatedFormat('d/m/Y');
    $namaPeriode = $tanggalObj->translatedFormat('F Y');
@endphp

<div class="alert alert-primary border-0 shadow-sm rounded-4 d-flex align-items-center mb-4 p-3" style="background: rgba(67, 97, 238, 0.05);">
    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; flex-shrink: 0;">
        <i class="bi bi-calendar-range fs-5"></i>
    </div>
    <div>
        <h6 class="fw-bold mb-0 text-primary">Periode Monitoring: {{ $namaPeriode }}</h6>
        <p class="text-muted small mb-0">
            Menampilkan data kenaikan antara <strong>{{ $awalBulan }}</strong> s/d <strong>{{ $akhirBulan }}</strong>
        </p>
    </div>
</div>