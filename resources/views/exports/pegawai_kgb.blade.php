<table>
    {{-- Loop untuk setiap Tahun (Group) --}}
    @foreach($data_per_tahun as $tahun => $pegawais)
        
        {{-- Jarak antar tabel tahun (jika bukan tahun pertama) --}}
        @if(!$loop->first)
            <tr><td></td><td></td><td></td></tr>
        @endif

        {{-- HEADER KUNING (KGB TAHUN XXXX) --}}
        <tr>
            <td colspan="3" style="background-color: #FFFF00; font-weight: bold; text-align: center; border: 1px solid #000000; font-size: 14px; height: 30px; vertical-align: middle;">
                KGB TAHUN {{ $tahun }}
            </td>
        </tr>

        {{-- HEADER KOLOM (Biru) --}}
        <tr>
            <td style="background-color: #4472C4; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: center; width: 5; vertical-align: middle;">No</td>
            <td style="background-color: #4472C4; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: center; width: 40; vertical-align: middle;">Nama Pegawai</td>
            <td style="background-color: #4472C4; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: center; width: 20; vertical-align: middle;">Bulan KGB</td>
        </tr>

        {{-- DATA PEGAWAI --}}
        @foreach($pegawais as $index => $p)
            @php
                // Logika Warna Berdasarkan Bulan
                $bulan = $p->next_kgb->format('m');
                $bg_color = '#FFFFFF'; // Default Putih

                // Warna sesuai request (sesuaikan kode hex jika ingin persis)
                if ($bulan == '01') $bg_color = '#F2DCDB';      // Merah Muda (Januari)
                elseif ($bulan == '02') $bg_color = '#FFFF00';  // Kuning (Februari)
                elseif ($bulan == '03') $bg_color = '#D8E4BC';  // Hijau Muda (Maret)
                elseif ($bulan == '04') $bg_color = '#00B050';  // Hijau Tua (April)
                elseif ($bulan == '05') $bg_color = '#00B0F0';  // Biru Muda (Mei)
                elseif ($bulan == '06') $bg_color = '#0070C0';  // Biru Tua (Juni)
                elseif ($bulan == '07') $bg_color = '#7030A0';  // Ungu (Juli)
                elseif ($bulan == '08') $bg_color = '#FF0000';  // Merah (Agustus)
                elseif ($bulan == '09') $bg_color = '#FFC000';  // Oranye (September)
                elseif ($bulan == '10') $bg_color = '#D9D9D9';  // Abu-abu (Oktober)
                elseif ($bulan == '11') $bg_color = '#1F497D';  // Biru Dongker (November)
                elseif ($bulan == '12') $bg_color = '#E26B0A';  // Coklat (Desember)
            @endphp

            <tr>
                <td style="background-color: {{ $bg_color }}; border: 1px solid #000000; text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="background-color: {{ $bg_color }}; border: 1px solid #000000; vertical-align: middle;">{{ $p->nama_lengkap }}</td>
                {{-- Format Tanggal: d-m-Y (contoh: 01-01-2026) --}}
                <td style="background-color: {{ $bg_color }}; border: 1px solid #000000; text-align: center; vertical-align: middle;">{{ $p->next_kgb->format('d-m-Y') }}</td>
            </tr>
        @endforeach

    @endforeach
</table>