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
            {{-- <th>Total Kehadiran</th> --}}
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
                    @if ($present->where('user_id', $user->id))
                        <td>{{ $present->where('user_id', $user->id)->first()->keterangan }}</td>
                        @php
                            $total_jam_kerja += $present->where('user_id', $user->id)->first()->jam_kerja;
                            $total_kehadiran += $present->where('user_id', $user->id)->first()->keterangan == 'Masuk' ? 1 : 0;
                            $uang_makan_harian_yang_diterima += $present->where('user_id', $user->id)->first()->keterangan == 'Masuk' ? $uang_makan_per_hari : 0;
                        @endphp
                    @endif
                @endforeach
                {{-- <td class="text-right">{{ $total_jam_kerja }}</td> --}}
                <td class="text-right">{{ $total_kehadiran }}</td>
                <td class="text-right">40.000</td>
                <td class="text-right">{{ number_format($uang_makan_harian_yang_diterima, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
