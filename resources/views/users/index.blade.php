@extends('layouts.admin', ['title', 'Daftar Users | Kantor Walikota-Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar User</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title text-primary">Daftar User</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * ($users->perPage()) + $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->level }}</td>
                                <td>
                                    @if ($user->status == 1)
                                        <span class="badge badge-success">Aktif</span>
                                    @elseif ($user->status == 0)
                                        <span class="badge badge-dark">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                        <a href="#" class="btn btn-circle btn-sm btn-primary" data-toggle="modal" data-target="#editModal-{{ $user->id }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        @if ($user->level != 'kepala_kantor')
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-circle btn-sm btn-danger" onclick="return confirm('Apakah ingin menghapus data tersebut?');">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="float-right">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  @foreach ($users as $user)
    <div class="modal fade" id="editModal-{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('user.update', $user->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="">Nama</label>
                    <p class="text-primary">{{ $user->name }}</p>
                </div>
                <div class="form-group">
                    <label for="">Level</label>
                    <p class="text-primary">{{ $user->level }}</p>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="" class="form-control">
                        {{-- <option value="pending" {{ $leave->status == 'pending' ? 'selected' : '' }} disabled>Pending</option> --}}
                        <option value="1" {{ $user->status == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $user->status == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
        </div>
    </div>
  @endforeach

@endsection