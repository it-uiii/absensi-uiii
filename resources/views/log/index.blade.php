@extends('layouts.app')

@section('title')
Logs - {{ config('app.name') }}
@endsection

@section('content')

<!-- Begin Page Content -->
<div class="card shadow h-100">
    <div class="card-header">
        <h5 class="m-0 pt-1 font-weight-bold float-left">Activity Logs</h5>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- <div class="col-lg-6 mb-1">
                <form action="{{ route('kehadiran.search') }}" method="get">
                    <div class="form-group row">
                        <label for="tanggal" class="col-form-label col-sm-3">Tanggal</label>
                        <div class="input-group col-sm-9">
                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">Cari</button>
                                <a href="{{ route('kehadiran.excel-users') }}?tanggal={{ request('tanggal', date('Y-m-d')) }}" class="btn btn-success" data-toggle="tooltip" title="Export Excel"><i class="fas fa-download"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div> --}}
            <div class="col-lg-6">
                <div class="float-right">
                    {{ $logs->links('layouts.pagination') }}
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Log</th>
                        <th>Description</th>
                        <th>User</th>
                        <th>created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$logs->count())
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data yang tersedia</td>
                        </tr>
                    @else
                        @foreach ($logs as $result)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result->log_name }}</td>
                                <td>{{ $result->description }}</td>
                                {{-- <td>{{ $result->user->nama }}</td> --}}
                                <td>{{ $result->causer_id }}</td>
                                <td>{{ $result->created_at }}</td>
                                <td>{{ $result->updated_at }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection