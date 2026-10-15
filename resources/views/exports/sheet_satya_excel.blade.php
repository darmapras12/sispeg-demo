<table>
    <thead>
        <tr>
            <th style="background-color: #FFD700; border: 1px solid #000; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: #FFD700; border: 1px solid #000; font-weight: bold; text-align: center;">Nama Pegawai</th>
            {{-- PERBAIKAN: Nama kolom disederhanakan menjadi Masa Kerja --}}
            <th style="background-color: #FFD700; border: 1px solid #000; font-weight: bold; text-align: center;">Masa Kerja</th>
            <th style="background-color: #FFD700; border: 1px solid #000; font-weight: bold; text-align: center;">Prediksi Kelayakan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $p)
            @php
                $nip = (string) $p->nip;
                $status = "N/A";
                $thn = 0;

                // Validasi: NIP harus minimal 14 digit untuk mengambil TMT Pengangkatan
                if (strlen($nip) >= 14) {
                    try {
                        $tmtRaw = substr($nip, 8, 6); // Ambil YYYYMM
                        $tahunTmt = substr($tmtRaw, 0, 4);
                        $bulanTmt = substr($tmtRaw, 4, 2);

                        // Gunakan createFromDate dengan penanganan error
                        $start = \Carbon\Carbon::create((int)$tahunTmt, (int)$bulanTmt, 1, 0, 0, 0);
                        $target = \Carbon\Carbon::create(2026, 8, 31, 23, 59, 59);
                        
                        // PERBAIKAN: Memastikan hasil adalah integer bulat (tanpa desimal)
                        $thn = (int) $start->diffInYears($target);

                        if ($thn >= 30) {
                            $status = "30 THN (EMAS)";
                        } elseif ($thn >= 20) {
                            $status = "20 THN (PERAK)";
                        } elseif ($thn >= 10) {
                            $status = "10 THN (PERUNGGU)";
                        } else {
                            $status = "BELUM LAYAK";
                        }
                    } catch (\Exception $e) {
                        $status = "Data NIP Error";
                    }
                } else {
                    $status = "NIP Tidak Valid";
                }
            @endphp
            <tr>
                <td style="border: 1px solid #000; text-align: center;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000;">{{ $p->nama_lengkap }}</td>
                {{-- Menampilkan angka bulat saja --}}
                <td style="border: 1px solid #000; text-align: center;">{{ $thn }} Tahun</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>