<table>
    <thead>
        <tr>
            <th style="background-color: #4361ee; color: white; border: 1px solid #000; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: #4361ee; color: white; border: 1px solid #000; font-weight: bold; text-align: center;">Nama Pegawai</th>
            <th style="background-color: #4361ee; color: white; border: 1px solid #000; text-align: center; font-weight: bold;">Tanggal Mutasi</th>
            <th style="background-color: #4361ee; color: white; border: 1px solid #000; text-align: center; font-weight: bold;">Catatan Mutasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $p)
        <tr>
            <td style="border: 1px solid #000; text-align: center;">{{ $loop->iteration }}</td>
            <td style="border: 1px solid #000;">{{ $p->nama_lengkap }}</td>
            <td style="border: 1px solid #000; text-align: center;">
                {{ $p->tanggal_mutasi ? \Carbon\Carbon::parse($p->tanggal_mutasi)->format('d/m/Y') : '-' }}
            </td>
            <td style="border: 1px solid #000; text-align: center;"> {{-- Diubah ke text-align: center --}}
                {{ !empty($p->catatan_status) ? $p->catatan_status : '-' }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>