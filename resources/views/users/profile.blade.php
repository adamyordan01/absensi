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
    <div class="col-md-6">
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
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">No Handphone</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control-plaintext" value="{{ Auth::user()->phone }}" readonly disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control-plaintext" value="{{ Auth::user()->address }}" readonly disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIP</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control-plaintext" value="{{ Auth::user()->nip }}" readonly disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Pangkat/Golongan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control-plaintext" value="{{ Auth::user()->rank->group . '/' . Auth::user()->rank->rank }}" readonly disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Bagian</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control-plaintext" value="{{ Auth::user()->division->division }}" readonly disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Foto</label>
                    <div class="col-sm-8">
                        <img src="{{ Auth::user()->take_picture }}" class="img-profile rounded-circle" alt="" width="100px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-5">
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
                <form action="{{ route('profile-update') }}" method="post" enctype="multipart/form-data">
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
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">No Hand Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}">
                            <p class="text-danger">{{ $errors->first('address') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nip" class="col-sm-3 col-form-label">Nomor Induk Pegawai</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nip" id="nip" value="{{ $user->nip }}">
                            <p class="text-danger">{{ $errors->first('nip') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rank" class="col-sm-3 col-form-label">Pangkat Golongan</label>
                        <div class="col-sm-9">
                            <select name="rankandgroup_id" id="rank" class="form-control">
                                <option value="" disabled selected>Pilih Pangkat dan Golongan</option>
                                @foreach ($ranks as $rank)
                                    <option value="{{ $rank->id }}" {{ $user->rankandgroup_id == $rank->id ? 'selected' : '' }}>{{ $rank->rank }}</option>
                                @endforeach
                        </select>
                            </select>
                            <p class="text-danger">{{ $errors->first('rankandgroup_id') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="division" class="col-sm-3 col-form-label">Bagian</label>
                        <div class="col-sm-9">
                            <select name="division_id" id="division" class="form-control">
                                <option value="" disabled selected>Pilih Divisi</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected' : '' }}>{{ $division->division }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('division_id') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="col-sm-3 col-form-label">Foto</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="photo" id="photo" value="{{ $user->photo }}">
                            <p class="text-danger">{{ $errors->first('photo') }}</p>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary float-right">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection