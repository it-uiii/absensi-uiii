<table>
    <tbody>
        <tr><td>NRP</td><td>: {{ $user->nrp }}</td></tr>
        <tr><td>Nama</td><td>: {{ $user->nama }}</td></tr>
        <tr><td>Jabatan</td><td>: {{ $user->jabatan }}</td></tr>
        <tr><td>Sebagai</td><td>: {{ $user->role->role }}</td></tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Total Jam</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presents as $present)
            <tr>
                <td>{{ date('d/m/Y', strtotime($present->tanggal)) }}</td>
                <td>{{ $present->keterangan }}</td>
                @if ($present->jam_masuk)
                    <td>{{ date('H:i:s', strtotime($present->jam_masuk)) }}</td>
                @else
                    <td>-</td>
                @endif
                @if($present->jam_keluar)
                    <td>{{ date('H:i:s', strtotime($present->jam_keluar)) }}</td>
                    <td>
                        {{ $present->jam_kerja }}
                    </td>
                @else
                    <td>-</td>
                    <td>-</td>
                @endif
            </tr>
        @endforeach
        <tr>
            <td colspan="5"><b>Total Telat {{ $totalJamTelat }} Jam Bulan Ini</b></td>
        </tr>
    </tbody>
</table>
