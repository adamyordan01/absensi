@extends('layouts.admin', ['title', 'Dashboard | Absensi'])

@section('content')
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        {{-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">#</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Kategori Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">#</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jumlah Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">#</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Log Stock</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">#</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-md">
            <div class="jumbotron">
                <h1 class="display-4">Selamat datang, {{ Auth::user()->name }}</h1>
                <p class="lead">Anda telah masuk kedalam aplikasi absensi Kantor Walikota - Kota Langsa. Silahkan lakukan absensi masuk pada menu absensi yang terdapat pada sisi kiri. </p>
                <hr class="my-4">
                <p>Anda dapat menekan tombol dibawah ini untuk langsung masuk pada halaman absensi masuk.</p>
                <p class="lead">
                  <a class="btn btn-primary btn-lg" href="{{ route('attendance-in') }}" role="button">Absen Masuk</a>
                </p>
            </div>
        </div>
    </div>
@endsection

