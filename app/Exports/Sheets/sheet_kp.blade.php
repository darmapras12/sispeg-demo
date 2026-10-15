<table>
    @foreach ($groupedKP as $year => $items)
        <tr>
            <td colspan="3"
                style="background-color:#FFC000;font-weight:bold;text-align:center;border:1px solid #000;">
                KP TAHUN {{ $year }}
            </td>
        </tr>

        <tr>
            <td style="background-color:#1F497D;color:white;font-weight:bold;border:1px solid #000;text-align:center;">
                No
            </td>
            <td style="background-color:#1F497D;color:white;font-weight:bold;border:1px solid #000;text-align:center;">
                Nama Pegawai (KP)
            </td>
            <td style="background-color:#1F497D;color:white;font-weight:bold;border:1px solid #000;text-align:center;">
                Tgl Target KP
            </td>
        </tr>

        @foreach ($items as $p)
            @php
                $bulan = \Carbon\Carbon::parse($p->next_kp)->format('m');
                $bg = match ($bulan) {
                    '01' => '#F2DCDB',
                    '02' => '#FFFF00',
                    '03' => '#D8E4BC',
                    '04' => '#00B050',
                    '05' => '#00B0F0',
                    '06' => '#0070C0',
                    '07' => '#7030A0',
                    '08' => '#FF0000',
                    '09' => '#FFC000',
                    '10' => '#D9D9D9',
                    '11' => '#1F497D',
                    '12' => '#E26B0A',
                    default => '#FFFFFF',
                };
            @endphp

            <tr>
                <td style="background-color:{{ $bg }};border:1px solid #000;text-align:center;">
                    {{ $loop->iteration }}
                </td>
                <td style="background-color:{{ $bg }};border:1px solid #000;">
                    {{-- PERBAIKAN: Hanya menampilkan nama tanpa NIP dalam kurung --}}
                    {{ $p->nama_lengkap }}
                </td>
                <td style="background-color:{{ $bg }};border:1px solid #000;text-align:center;">
                    {{ \Carbon\Carbon::parse($p->next_kp)->format('d-m-Y') }}
                </td>
            </tr>
        @endforeach

        <tr><td colspan="3"></td></tr>
    @endforeach
</table>