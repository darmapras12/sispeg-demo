@php
    // 1. Cari jumlah baris terbanyak
    $maxRows = 0;
    foreach($groupedKP as $items) {
        if($items->count() > $maxRows) {
            $maxRows = $items->count();
        }
    }
    
    // 2. Reset Keys
    $groupedValues = [];
    foreach($groupedKP as $year => $items) {
        $groupedValues[$year] = $items->values();
    }
@endphp

<table>
    {{-- BARIS 1: HEADER TAHUN (Warna Emas/Oranye) --}}
    <tr>
        @foreach ($groupedKP as $year => $items)
            <td colspan="3" style="background-color:#FFC000; font-weight:bold; text-align:center; border:1px solid #000; color: #000000;">
                KP TAHUN {{ $year }}
            </td>
            {{-- Spacer --}}
            <td style="width: 15px;"></td> 
        @endforeach
    </tr>

    {{-- BARIS 2: SUB JUDUL KOLOM (Warna Berbeda: Abu-abu Biru Muda) --}}
    <tr>
        @foreach ($groupedKP as $year => $items)
            <td style="background-color:#E2E8F0; font-weight:bold; border:1px solid #000; text-align:center; color: #1E293B;">No</td>
            <td style="background-color:#E2E8F0; font-weight:bold; border:1px solid #000; text-align:center; color: #1E293B;">Nama Pegawai</td>
            <td style="background-color:#E2E8F0; font-weight:bold; border:1px solid #000; text-align:center; color: #1E293B;">Tgl Target KP</td>
            <td></td> {{-- Spacer --}}
        @endforeach
    </tr>

    {{-- BARIS 3 DST: DATA PEGAWAI --}}
    @for ($i = 0; $i < $maxRows; $i++)
        <tr>
            @foreach ($groupedKP as $year => $items)
                @if (isset($groupedValues[$year][$i]))
                    @php
                        $p = $groupedValues[$year][$i];
                    @endphp
                    <td style="border:1px solid #000; text-align:center;">
                        {{ $i + 1 }}
                    </td>
                    <td style="border:1px solid #000;">
                        {{ $p->nama_lengkap }}
                    </td>
                    <td style="border:1px solid #000; text-align:center;">
                        {{ \Carbon\Carbon::parse($p->next_kp)->format('d-m-Y') }}
                    </td>
                @else
                    {{-- PENTING: Sel tanpa border agar tidak muncul kotak kosong di bawah --}}
                    <td></td><td></td><td></td>
                @endif
                
                <td></td> {{-- Spacer --}}
            @endforeach
        </tr>
    @endfor
</table>