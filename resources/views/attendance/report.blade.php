@extends('layouts.admin', ['title', 'Report | Kantor Walikota - Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Laporan</li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-6">
                        <h5 class="card-title">Laporan absensi</h5>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-md">
                            <form action="{{ route('attendance-report') }}" method="GET" class="form-inline my-2 my-lg-0 float-right">
                                <div class="input-group mb-3">
                                    <input type="text" id="created_at" name="date" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">Filter</button>
                                    </div>
                                    <a target="_blank" class="btn btn-primary ml-2" id="printPdf">Print Report</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pegawai</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>TTD Masuk</th>
                                    <th>Photo Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>TTD Pulang</th>
                                    <th>Photo Pulang</th>
                                    <th>Jumlah Jam Kerja</th>
                                    <th>Ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $attendance->user->name }}</strong>
                                        </td>
                                        <td>{{ $attendance->when }}</td>
                                        <td>{{ $attendance->in }}</td>
                                        <td>
                                            <img class="text-center" src="{{ asset($attendance->attendance_in) }}" width="150px" alt="">
                                        </td>
                                        <td>
                                            <img class="text-center" src="{{ asset($attendance->photo_in) }}" width="150px" alt="">
                                        </td>
                                        <td>{{ $attendance->out }}</td>
                                        <td>
                                            <img class="text-center" src="{{ asset($attendance->attendance_out) }}" width="150px" alt="">
                                        </td>
                                        <td>
                                            <img class="text-center" src="{{ asset($attendance->photo_out) }}" width="150px" alt="">
                                        </td>
                                        <td>{{ $attendance->total }}</td>
                                        <td>
                                            @if ($attendance->annotation == 'ditolak')
                                                <p>Anda Tidak diperbolehkan cuti.</p>
                                            @elseif ($attendance->annotation == 'disetujui')
                                                <p>Anda Diperbolehkan cuti.</p>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- {{ $items->appends($request)->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

    {{-- <script>
        //KETIKA PERTAMA KALI DI-LOAD MAKA TANGGAL NYA DI-SET TANGGAL SAA PERTAMA DAN TERAKHIR DARI BULAN SAAT INI
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

            //KEMUDIAN TOMBOL EXPORT PDF DI-SET URLNYA BERDASARKAN TGL TERSEBUT
            $('#exportpdf').attr('href', '/attendance-report/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            //INISIASI DATERANGEPICKER
            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
                $('#exportpdf').attr('href', '/attendance-report/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script> --}}
    <script>
        //KETIKA PERTAMA KALI DI-LOAD MAKA TANGGAL NYA DI-SET TANGGAL SAA PERTAMA DAN TERAKHIR DARI BULAN SAAT INI
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

            //KEMUDIAN TOMBOL EXPORT PDF DI-SET URLNYA BERDASARKAN TGL TERSEBUT
            // $('#exportpdf').attr('href', '/attendance-report-admin/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))
            $('#printPdf').attr('href', '/attendance-report-user/print/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            //INISIASI DATERANGEPICKER
            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
                // $('#exportpdf').attr('href', '/attendance-report-admin/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
                $('#printPdf').attr('href', '/attendance-report-user/print/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script>
@endsection