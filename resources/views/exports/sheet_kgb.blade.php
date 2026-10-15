@php
    // 1. Cari max rows
    $maxRows = 0;
    foreach($groupedKGB as $items) {
        if($items->count() > $maxRows) {
            $maxRows = $items->count();
        }
    }
    
    // 2. Reset Keys
    $groupedValues = [];
    foreach($groupedKGB as $year => $items) {
        $groupedValues[$year] = $items->values();
    }
@endphp

<table>
    {{-- BARIS 1: HEADER TAHUN --}}
    <tr>
        @foreach ($groupedKGB as $year => $items)
            <td colspan="3" style="background-color: #FFFF00; font-weight: bold; text-align: center; border: 1px solid #000;">
                KGB TAHUN {{ $year }}
            </td>
            <td style="width: 15px;"></td> {{-- Spacer --}}
        @endforeach
    </tr>

    {{-- BARIS 2: SUB-HEADER KOLOM --}}
    <tr>
        @foreach ($groupedKGB as $year => $items)
            <td style="background-color: #4472C4; color: white; font-weight: bold; border: 1px solid #000; text-align: center;">No</td>
            <td style="background-color: #4472C4; color: white; font-weight: bold; border: 1px solid #000; text-align: center;">Nama Pegawai</td>
            <td style="background-color: #4472C4; color: white; font-weight: bold; border: 1px solid #000; text-align: center;">Tgl Target KGB</td>
            <td></td> {{-- Spacer --}}
        @endforeach
    </tr>

    {{-- BARIS 3 DST: DATA --}}
    @for ($i = 0; $i < $maxRows; $i++)
        <tr>
            @foreach ($groupedKGB as $year => $items)
                @if (isset($groupedValues[$year][$i]))
                    @php
                        $p = $groupedValues[$year][$i];
                    @endphp
                    <td style="border: 1px solid #000; text-align: center;">{{ $i + 1 }}</td>
                    <td style="border: 1px solid #000;">{{ $p->nama_lengkap }}</td>
                    <td style="border: 1px solid #000; text-align: center;">{{ $p->next_kgb->format('d-m-Y') }}</td>
                @else
                    {{-- PENTING: Sel kosong tanpa border agar tidak muncul kotak kosong di bawah --}}
                    <td></td><td></td><td></td>
                @endif
                <td></td> {{-- Spacer --}}
            @endforeach
        </tr>
    @endfor
</table>