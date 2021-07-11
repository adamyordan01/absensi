@extends('layouts.admin', ['title', 'Absensi | Kantor Walikota-Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Izin Cuti</li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('success'))
                <div class="alert alert-success"><i class="fas fa-check"></i> {{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger"><i class="fas fa-ban"></i> {{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">List Cuti</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('annotation.create') }}" class="btn btn-primary float-right my-2">Buat Izin Cuti</a>
                    <h5>
                        List Permohonan Cuti
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <th>#</th>
                                <th>Nama Pegawai</th>
                                <th>Jenis Izin Cuti</th>
                                <th>Keterangan</th>
                                <th>Tanggal Izin</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @forelse ($leaves as $leave)
                                    <tr>
                                        <td>{{ ($leaves->currentPage() - 1) * ($leaves->perPage()) + $loop->iteration }}</td>
                                        <td>{{ $leave->user->name }}</td>
                                        <td>{{ $leave->leave }}</td>
                                        <td>{{ $leave->annotation }}</td>
                                        <td>{{ $leave->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($leave->status == 'pending')
                                                <p class="badge badge-dark">Pending</p>
                                            @elseif ($leave->status == 'disetujui')
                                                <p class="badge badge-success">Disetujui</p>
                                            @elseif ($leave->status == 'ditolak')
                                                <p class="badge badge-danger">Ditolak</p>   
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Data Belum Tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection