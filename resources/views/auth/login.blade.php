@extends('layouts.auth', ['title' => 'Login | Kantor Walikota | Kota Langsa'])

@section('content')
<div class="row justify-content-center mt-5">

    <div class="col-md-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4 pt-2 pb-2">Kantor Walikota - Kota Langsa</h1>
                    </div>
                    <form action="{{ route('login') }}" class="user" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                            
                            @error('email')
                                <span class="invalid-feedback mt-2 ml-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label" for="customCheck">Remember
                                    Me</label>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-user btn-block mb-4">
                            login
                        </button>
                        {{-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                            Login
                        </a>
                        <hr>
                        <a href="index.html" class="btn btn-google btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i> Login with Google
                        </a>
                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                        </a> --}}
                    </form>
                    <hr>
                    {{-- <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div> --}}
                    <div class="text-center">
                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

