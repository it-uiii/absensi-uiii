@extends('layouts.app')

@section('title')
Laporan - {{ config('app.name') }}
@endsection

@section('content')

<!-- Begin Page Content -->
    <div class="container">
        <div class="card shadow h-100">
            <div class="card-header">
                <h5 class="m-0 pt-1 font-weight-bold float-left">Rekap Kehadiran</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-sm mb-1">
                            <div class="form-group row">
                                <label for="tanggal" class="col-form-label col-sm-3">Tanggal Awal</label>
                                <div class="input-group col-sm-9">
                                    <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" value="{{ request('tanggal_awal', date('Y-m-d',strtotime('-1 months'))) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal" class="col-form-label col-sm-3">Tanggal Akhir</label>
                                <div class="input-group col-sm-9">
                                    <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="{{ request('tanggal_akhir', date('Y-m-d')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary" type="submit">Cari</button>
                        <a href="{{ route('kehadiran.reports-excel') }}?tanggal_awal={{ request('tanggal_awal', date('Y-m-d',strtotime('-1 months'))) }}&tanggal_akhir={{ request('tanggal_akhir', date('Y-m-d')) }}" class="btn btn-success" >Download Excel</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
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
                                        @if ($present->where('user_id', $user->id))
                                            <td class="text-center">{{ $present->where('user_id', $user->id)->first()->ket }}</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-body">
                <h3>Keterangan</h4>
                <table>
                    <tr>
                        <td>1</td>
                        <td width="5px">:</td>
                        <td>Masuk / Telat</td>
                    </tr>
                    <tr>
                        <td>S</td>
                        <td width="5px">:</td>
                        <td>Sakit</td>
                    </tr>
                    <tr>
                        <td>C</td>
                        <td width="5px">:</td>
                        <td>Cuti</td>
                    </tr>
                    <tr>
                        <td>DL</td>
                        <td width="5px">:</td>
                        <td>Perjadin</td>
                    </tr>
                    <tr>
                        <td>FB</td>
                        <td width="5px">:</td>
                        <td>Fullboard</td>
                    </tr>
                    <tr>
                        <td>I</td>
                        <td width="5px">:</td>
                        <td>Izin</td>
                    </tr>
                    <tr>
                        <td>A</td>
                        <td width="5px">:</td>
                        <td>Alpha</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->

@endsection
