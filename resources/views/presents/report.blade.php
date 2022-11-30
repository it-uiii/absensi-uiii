<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Jabatan</th>
            @foreach ($presents as $key => $item)
                <th>{{ date('d-m-Y', strtotime($key)) }}</th>
            @endforeach
            <th>Total Jam Kerja</th>
            <th>Total Kehadiran</th>
            <th>Uang Makan per Hari</th>
            <th>Uang Makan Harian yang Diterima</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            @php
                $total_jam_kerja = 0;
                $total_kehadiran = 0;
                $uang_makan_per_hari = 40000;
                $uang_makan_harian_yang_diterima = 0;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->nrp }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->role->role }}</td>
                @foreach ($presents as $key => $present)
                    @if (count($present->where('user_id', $user->id)) > 0)
                        <td style="text-align: center">{{ $present->where('user_id', $user->id)->first()->ket }}</td>
                        @php
                            $keterangan = $present->where('user_id', $user->id)->first()->keterangan;
                            $total_jam_kerja += $present->where('user_id', $user->id)->first()->jam_kerja;
                            $total_kehadiran += $keterangan == 'Masuk' || $keterangan == 'Telat' ? 1 : 0;
                            $uang_makan_harian_yang_diterima += $keterangan == 'Masuk' || $keterangan == 'Telat' ? $uang_makan_per_hari : 0;
                        @endphp
                    @endif
                @endforeach
                <td class="text-right">{{ $total_jam_kerja }}</td>
                <td class="text-right">{{ $total_kehadiran }}</td>
                <td class="text-right">40.000</td>
                <td class="text-right">{{ number_format($uang_makan_harian_yang_diterima, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr></tr>
        <tr><td></td><td></td><td>Keterangan:</td></tr>
        <tr><td></td><td></td><td>1 : Masuk / Telat</td></tr>
        <tr><td></td><td></td><td>S : Sakit</td></tr>
        <tr><td></td><td></td><td>C : Cuti</td></tr>
        <tr><td></td><td></td><td>WFH : Work From Home</td></tr>
        <tr><td></td><td></td><td>DL : Dinas Luar (Perjadin)</td></tr>
        <tr><td></td><td></td><td>FB : Full Board</td></tr>
        <tr><td></td><td></td><td>FD : Full Day</td></tr>
        <tr><td></td><td></td><td>I : Izin</td></tr>
        <tr><td></td><td></td><td>A : Alpha</td></tr>
    </tbody>
</table>
