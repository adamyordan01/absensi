@extends('layouts.admin', ['title', 'Absensi | Kantor Walikota-Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Form Cuti</li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Cuti</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('annotation.store') }}" method="post" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="leave">Jenis Cuti</label>
                            <select name="leave" id="leave" class="form-control">
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                                <option value="Dinas Luar Kota">Dinas Luar Kota</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="annotation">Keterangan</label>
                            <textarea name="annotation" id="annotation" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <p class="text-success">
                                Dengan ini saya ingin melakukan cuti kerja pada tanggal @php
                                echo date('d-m-Y')
                                @endphp
                            </p class="text-success">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection