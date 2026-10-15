<table>
    <thead>
        <tr>
            <th style="background-color: #D9D9D9; border: 1px solid #000; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: #D9D9D9; border: 1px solid #000; font-weight: bold; text-align: center;">Nama Lengkap</th>
            <th style="background-color: #D9D9D9; border: 1px solid #000; font-weight: bold; text-align: center;">Pangkat/Golongan</th>
            <th style="background-color: #D9D9D9; border: 1px solid #000; font-weight: bold; text-align: center;">Jabatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $p)
        <tr>
            <td style="border: 1px solid #000; text-align: center;">{{ $loop->iteration }}</td>
            <td style="border: 1px solid #000;">{{ $p->nama_lengkap }}</td>
            <td style="border: 1px solid #000;">{{ $p->pangkat_golongan ?? '-' }}</td>
            <td style="border: 1px solid #000;">{{ $p->jabatan ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>