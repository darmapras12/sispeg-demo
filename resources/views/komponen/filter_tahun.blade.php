<form action="{{ route('dashboard') }}" method="GET" id="formFilter" class="d-flex gap-2">
    <select name="bulan" class="form-select form-select-sm rounded-pill border-0 shadow-sm px-3" onchange="this.form.submit()" style="width: 130px; height: 38px;">
        <option value="">Semua Bulan</option>
        @for ($m = 1; $m <= 12; $m++)
            @php $val = sprintf('%02d', $m); @endphp
            <option value="{{ $val }}" {{ request('bulan') == $val ? 'selected' : '' }}>
                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
            </option>
        @endfor
    </select>

    <select name="tahun" class="form-select form-select-sm rounded-pill border-0 shadow-sm px-3" onchange="this.form.submit()" style="width: 100px; height: 38px;">
        <option value="">Tahun</option>
        @php $tahunSekarang = date('Y'); @endphp
        @for ($t = $tahunSekarang - 2; $t <= $tahunSekarang + 5; $t++)
            <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
        @endfor
    </select>
    
    @if(request('bulan') || request('tahun'))
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-white bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;" title="Reset Filter">
            <i class="bi bi-arrow-clockwise text-danger"></i>
        </a>
    @endif
</form>