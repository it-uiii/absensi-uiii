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
                <div class="row">
                    <div class="col-sm mb-1">
                        <form action="{{ route('kehadiran.search') }}" method="get">
                            <div class="form-group row">
                                <label for="tanggal" class="col-form-label col-sm-3">Tanggal Awal</label>
                                <div class="input-group col-sm-9">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal" class="col-form-label col-sm-3">Tanggal Akhir</label>
                                <div class="input-group col-sm-9">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <form action="" method="get">
                        <input type="hidden" name="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}">
                        <button class="btn btn-primary" type="submit" title="Download">Download Excel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->

@endsection
