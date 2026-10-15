<table>
    @for($i = 0; $i < $maxRows; $i++)
        <tr>
            {{-- SISI KIRI (KP) --}}
            @if(isset($flatKP[$i]))
                @php $row = $flatKP[$i]; @endphp

                @if($row['type'] == 'year_title')
                    <td colspan="3" style="background-color: #FFC000; font-weight: bold; text-align: center; border: 1px solid #000; font-size: 14px;">
                        KP TAHUN {{ $row['value'] }}
                    </td>
                @elseif($row['type'] == 'col_header')
                    <td style="background-color: #1F497D; border: 1px solid #000; width: 5; color: white; font-weight: bold; text-align: center;">No</td>
                    <td style="background-color: #1F497D; border: 1px solid #000; width: 35; color: white; font-weight: bold; text-align: center;">Nama Pegawai (KP)</td>
                    <td style="background-color: #1F497D; border: 1px solid #000; width: 20; color: white; font-weight: bold; text-align: center;">Tgl KP</td>
                @elseif($row['type'] == 'data')
                    @php
                        $p = $row['value'];
                        $bulan = $p->next_kp->format('m');
                        $bg = '#FFFFFF';
                        if ($bulan == '01') $bg = '#F2DCDB'; elseif ($bulan == '02') $bg = '#FFFF00';
                        elseif ($bulan == '03') $bg = '#D8E4BC'; elseif ($bulan == '04') $bg = '#00B050';
                        elseif ($bulan == '05') $bg = '#00B0F0'; elseif ($bulan == '06') $bg = '#0070C0';
                        elseif ($bulan == '07') $bg = '#7030A0'; elseif ($bulan == '08') $bg = '#FF0000';
                        elseif ($bulan == '09') $bg = '#FFC000'; elseif ($bulan == '10') $bg = '#D9D9D9';
                        elseif ($bulan == '11') $bg = '#1F497D'; elseif ($bulan == '12') $bg = '#E26B0A';
                    @endphp
                    <td style="background-color: {{ $bg }}; border: 1px solid #000; text-align: center;">{{ $row['index'] }}</td>
                    <td style="background-color: {{ $bg }}; border: 1px solid #000;">{{ $p->nama_lengkap }} ({{ $p->nip }})</td>
                    <td style="background-color: {{ $bg }}; border: 1px solid #000; text-align: center;">{{ $p->next_kp->format('d-m-Y') }}</td>
                @else
                    <td></td><td></td><td></td>
                @endif
            @else
                <td></td><td></td><td></td>
            @endif

            {{-- SPASI TENGAH --}}
            <td style="width: 2;"></td>

            {{-- SISI KANAN (KGB) --}}
            @if(isset($flatKGB[$i]))
                @php $row = $flatKGB[$i]; @endphp

                @if($row['type'] == 'year_title')
                    <td colspan="3" style="background-color: #FFFF00; font-weight: bold; text-align: center; border: 1px solid #000; font-size: 14px;">
                        KGB TAHUN {{ $row['value'] }}
                    </td>
                @elseif($row['type'] == 'col_header')
                    <td style="background-color: #4472C4; border: 1px solid #000; width: 5; color: white; font-weight: bold; text-align: center;">No</td>
                    <td style="background-color: #4472C4; border: 1px solid #000; width: 35; color: white; font-weight: bold; text-align: center;">Nama Pegawai (KGB)</td>
                    <td style="background-color: #4472C4; border: 1px solid #000; width: 20; color: white; font-weight: bold; text-align: center;">Tgl KGB</td>
                @elseif($row['type'] == 'data')
                    @php
                        $p = $row['value'];
                        $bulan = $p->next_kgb->format('m');
                        $bg = '#FFFFFF';
                        if ($bulan == '01') $bg = '#F2DCDB'; elseif ($bulan == '02') $bg = '#FFFF00';
                        elseif ($bulan == '03') $bg = '#D8E4BC'; elseif ($bulan == '04') $bg = '#00B050';
                        elseif ($bulan == '05') $bg = '#00B0F0'; elseif ($bulan == '06') $bg = '#0070C0';
                        elseif ($bulan == '07') $bg = '#7030A0'; elseif ($bulan == '08') $bg = '#FF0000';
                        elseif ($bulan == '09') $bg = '#FFC000'; elseif ($bulan == '10') $bg = '#D9D9D9';
                        elseif ($bulan == '11') $bg = '#1F497D'; elseif ($bulan == '12') $bg = '#E26B0A';
                    @endphp
                    <td style="background-color: {{ $bg }}; border: 1px solid #000; text-align: center;">{{ $row['index'] }}</td>
                    <td style="background-color: {{ $bg }}; border: 1px solid #000;">{{ $p->nama_lengkap }} ({{ $p->nip }})</td>
                    <td style="background-color: {{ $bg }}; border: 1px solid #000; text-align: center;">{{ $p->next_kgb->format('d-m-Y') }}</td>
                @else
                    <td></td><td></td><td></td>
                @endif
            @else
                <td></td><td></td><td></td>
            @endif
        </tr>
    @endfor
</table>