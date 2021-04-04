@extends('layouts.admin', ['title', 'Daftar Divisi | Kantor Walikota-Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Divisi</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <h6 class="card-title text-primary">Daftar Divisi</h6>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </div>
                </div>
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
                            <th>Divisi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($divisions as $division)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $division->division }}</td>
                                <td>
                                    <form action="{{ route('division.destroy', $division->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" data-toggle="modal" data-target="#editModal-{{ $division->id }}" class="btn btn-circle btn-sm btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button type="submit" class="btn btn-circle btn-sm btn-danger" onclick="return confirm('Apakah ingin menghapus data tersebut?');">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
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
            </div>
        </div>
    </div>
</div>

{{-- Modal add --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{ route('division.store') }}" method="post">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="">Nama Divisi</label>
                    <input type="text" name="division" id="" class="form-control" autofocus>
                    <p class="text-danger">{{ $errors->first('division') }}</p>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
    </div>
</div>

{{-- Modal Edit --}}
@foreach ($divisions as $division)
    <div class="modal fade" id="editModal-{{ $division->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Update Divisi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('division.update', $division->id) }}" method="post">
                <div class="modal-body">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Divisi</label>
                        <input type="text" name="division" id="" class="form-control" autofocus value="{{ old('division') ?? $division->division }}">
                        <p class="text-danger">{{ $errors->first('division') }}</p>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endforeach
@endsection