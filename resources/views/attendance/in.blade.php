@extends('layouts.admin', ['title', 'Barang | BPN Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Absensi Masuk</li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            @if (session('success'))
                <div class="alert alert-success"><i class="fas fa-check"></i> {{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger"><i class="fas fa-ban"></i> {{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-primary">Absensi Masuk | Silahkan melakukan absen.</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('attendance-in-store') }}" method="post">
                        @csrf
                        <div class="row justify-content-center align-items-center my-3">
                            <div class="col-md-3">
                                <h2 class="text-center text-primary font-weight-bold" id="jam"></h2>
                            </div>
                            <div class="col-md-1">
                                <h2 class="text-center text-grey font-weight-bold">:</h2>
                            </div>
                            <div class="col-md-3">
                                <h2 class="text-center text-primary font-weight-bold" id="menit"></h2>
                            </div>
                            <div class="col-md-1">
                                <h2 class="text-center text-grey font-weight-bold">:</h2>
                            </div>
                            <div class="col-md-3">
                                <h2 class="text-center text-primary font-weight-bold" id="detik"></h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mx-auto my-5">
                                <button type="submit" class="btn btn-lg btn-primary text-center">Klik Absensi Masuk</button>
                            </div>
                        </div>
                    </form>
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
	window.setTimeout("waktu()", 1000);
 
	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 1000);
		document.getElementById("jam").innerHTML = waktu.getHours();
		document.getElementById("menit").innerHTML = waktu.getMinutes();
		document.getElementById("detik").innerHTML = waktu.getSeconds();
	}
</script>
@endsection