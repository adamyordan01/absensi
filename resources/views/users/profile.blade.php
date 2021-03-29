@extends('layouts.admin', ['title', 'Ubah Profile | Kantor Walikota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title text-primary">Profile</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control-plaintext" value="{{ Auth::user()->name }}" readonly disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control-plaintext" value="{{ Auth::user()->email }}" readonly disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Level</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control-plaintext" value="{{ Auth::user()->level }}" readonly disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title text-primary">Change Profile</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form action="{{ route('profile-update') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">E-Mail</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary float-right">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection