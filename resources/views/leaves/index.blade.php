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
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger"><i class="fas fa-ban"></i> {{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">List Cuti</h5>
                </div>
                <div class="card-body">
                    <h5>
                        List Permohonan Cuti
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <th>#</th>
                                <th>Nama Pegawai</th>
                                <th>Jabatan</th>
                                <th>Jenis Izin Cuti</th>
                                <th>Keterangan</th>
                                <th>Tanggal Izin</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($leaves as $leave)
                                    <tr>
                                        <td>{{ ($leaves->currentPage() - 1) * ($leaves->perPage()) + $loop->iteration }}</td>
                                        <td>{{ $leave->user->name }}</td>
                                        <td>{{ $leave->user->position_id != NULL ? $leave->user->position->position_name : '-' }}</td>
                                        <td>{{ $leave->leave }}</td>
                                        <td>{{ $leave->annotation }}</td>
                                        <td>{{ $leave->when }}</td>
                                        <td>
                                            @if ($leave->status == 'pending')
                                                <p class="badge badge-dark">Pending</p>
                                            @elseif ($leave->status == 'disetujui')
                                                <p class="badge badge-success">Disetujui</p>
                                            @elseif ($leave->status == 'ditolak')
                                                <p class="badge badge-danger">Ditolak</p>   
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal-{{ $leave->id }}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Data Belum Tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
  <!-- Modal -->
  @foreach ($leaves as $leave)
    <div class="modal fade" id="editModal-{{ $leave->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('leave.update', $leave->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="">Nama</label>
                    <p class="text-primary">{{ $leave->user->name }}</p>
                </div>
                <div class="form-group">
                    <label for="">Jenis Cuti</label>
                    <p class="text-primary">{{ $leave->leave }}</p>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <p class="text-primary">{{ $leave->annotation }}</p>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Cuti</label>
                    <p class="text-primary">{{ $leave->when }}</p>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="" class="form-control">
                        {{-- <option value="pending" {{ $leave->status == 'pending' ? 'selected' : '' }} disabled>Pending</option> --}}
                        <option value="disetujui" {{ $leave->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ $leave->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
        </div>
    </div>
  @endforeach
@endsection