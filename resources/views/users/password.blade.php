@extends('layouts.admin', ['title', 'Ubah Password | Kantor Walikota-Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title text-primary">Change Password</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form action="{{ route('password-update') }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" class="form-control" name="current_password">
                        <p class="text-danger">{{ $errors->first('current_password') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" name="password">
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" class="form-control" name="password_confirmation">
                        {{-- <p class="text-danger">{{ $errors->first('current_password') }}</p> --}}
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-sm btn-primary float-right mt-3">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection