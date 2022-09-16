@extends('layouts.app')

@section('title')
Employees Management - {{ config('app.name') }}
@endsection

@section('header')
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Employees</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $users->count() }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Begin Page Content -->
<div class="container">
    <div class="card shadow h-100">
        <div class="card-header">
            <h5 class="m-0 pt-1 font-weight-bold float-left">Employees Management</h5>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right" title="Tambah User"><i class="fas fa-plus"></i></a>
            <button type="button" class="btn btn-success btn-sm float-right mr-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Import Employees
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <form action="{{ route('users.search') }}" method="get">
                        <input type="text" name="cari" id="cari" class="form-control mb-3" value="{{ request('cari') }}" placeholder="Cari . . ." autocomplete="off">
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="float-right">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NRP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Sebagai</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($users as $user)
                            <tr>
                                <th>{{ $rank++ }}</th>
                                <td>
                                    @if (empty($user->nrp))
                                        nrp not available
                                    @else
                                        {{ $user->nrp }}
                                    @endif
                                </td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->jabatan }}</td>
                                <td>{{ $user->role->role }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info" title="Detail User"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach  --}}
                        @if (!$users->count())
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data yang tersedia</td>
                                </tr>
                            @else
                                @foreach ($users as $user)
                                    <tr>
                                        <th>{{ $rank++ }}</th>
                                        <td>@if (empty($user->nrp))
                                                nrp not available
                                            @else
                                                {{ $user->nrp }}
                                            @endif</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->jabatan }}</td>
                                        <td>{{ $user->role->role }}</td>
                                        <td>
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info" title="Detail User"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                    </tbody>
                </table>                    
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import users</h5>
        </div>
        <div class="modal-body">
            <form action="/import" method="post" enctype="multipart/form-data">
            @csrf
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file">
                <label class="custom-file-label" for="file">upload xlsx</label>
                @error('file') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-gradient-success">Import</button>
        </div>
        </div>
        </form>
    </div>
</div>

@endsection
