@extends('layouts.auth', ['title' => 'Register | Kantor Walikota | Kota Langsa'])

@section('content')
<div class="row justify-content-center mt-5">

    <div class="col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="px-2 py-4">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4 pt-2 pb-2 mt-2">Register | Kantor Walikota - Kota Langsa</h1>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">No Hand Phone
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">Alamat
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
                            <p class="text-danger">{{ $errors->first('address') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nip" class="col-md-4 col-form-label text-md-right">Nomor Induk Pegawai</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="nip" id="nip" value="{{ old('nip') }}">
                            <p class="text-danger">{{ $errors->first('nip') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rank" class="col-md-4 col-form-label text-md-right">Pangkat Golongan</label>
                        <div class="col-md-7">
                            <select name="rankandgroup_id" id="rank" class="form-control">
                                <option value="">Tidak ada</option>
                                @foreach ($ranks as $rank)
                                    <option value="{{ $rank->id }}">{{ $rank->group . " - " . $rank->rank }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('rankandgroup_id') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="division" class="col-md-4 col-form-label text-md-right">Bagian
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-7">
                            <select name="division_id" id="division" class="form-control">
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->division }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('division_id') }}</p>
                        </div>
                    </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-4">
                                <button type="submit" class="btn btn-primary float-right">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    {{-- <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div> --}}
                    <div class="text-center mb-3">
                        <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection