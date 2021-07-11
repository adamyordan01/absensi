
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kantor Walikota - Kota Langsa</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets') }}/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" onload="window.print()">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h5 class="text-center mt-5 mb-3">Laporan Absensi Periode {{ Carbon\Carbon::parse($date[0])->format('d-m-Y') }} - {{ Carbon\Carbon::parse($date[1])->format('d-m-Y') }}</h5>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>TTD Masuk</th>
                            <th>Foto Masuk</th>
                            <th>Jam Pulang</th>
                            <th>TTD Pulang</th>
                            <th>Foto Pulang</th>
                            <th>Jumlah Jam Kerja</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attendance->user->name }}</td>
                                <td>{{ Carbon\Carbon::parse($attendance->when)->format('d-m-Y') }}</td>
                                <td>{{ $attendance->out }}</td>
                                <td>
                                    <img src="{{ asset($attendance->attendance_in) }}" width="50px" alt="">
                                </td>
                                <td>
                                    <img src="{{ asset($attendance->photo_in) }}" width="50px" alt="">
                                </td>
                                <td>{{ $attendance->out }}</td>
                                <td>
                                    <img src="{{ asset($attendance->attendance_out) }}" width="50px" alt="">
                                </td>
                                <td>
                                    <img src="{{ asset($attendance->photo_out) }}" width="50px" alt="">
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
                                <td colspan="6">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets') }}/js/sb-admin-2.min.js"></script>

</body>

</html>











{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        *{
            font-family: Quicksand;
        }
    </style>
</head>
<body> --}}
    {{-- <h5 class="text-center">Laporan Absensi Periode {{ Carbon\Carbon::parse($date[0])->format('d-m-Y') }} - {{ Carbon\Carbon::parse($date[1])->format('d-m-Y') }}</h5> --}}
{{-- 
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>TTD Masuk</th>
                <th>Jam Pulang</th>
                <th>TTD Pulang</th>
                <th>Jumlah Jam Kerja</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($attendances as $attendance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ Carbon\Carbon::parse($attendance->when)->format('d-m-Y') }}</td>
                    <td>
                        <img src="{{ asset($attendance->attendance_in) }}" width="150px" alt="">
                    </td>
                    <td>{{ $attendance->out }}</td>
                    <td>
                        <img src="{{ asset($attendance->attendance_out) }}" width="150px" alt="">
                    </td>
                    <td>{{ $attendance->out }}</td>
                    <td>{{ $attendance->total }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Data tidak tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html> --}}