<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Kantor Walikota | Kota Langsa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        *{
            font-family: Quicksand;
        }
    </style>
</head>
<body>
    <h5 class="text-center">Laporan Absensi Periode {{ Carbon\Carbon::parse($date[0])->format('d-m-Y') }} - {{ Carbon\Carbon::parse($date[1])->format('d-m-Y') }}</h5>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Jumlah Jam Kerja</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($attendances as $attendance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ Carbon\Carbon::parse($attendance->when)->format('d-m-Y') }}</td>
                    <td>{{ $attendance->in }}</td>
                    <td>
                        <img src="{{ asset($attendance->attendance_in) }}" width="150px" alt="">
                    </td>
                    <td>{{ $attendance->out }}</td>
                    <td>
                        <img src="{{ asset($attendance->attendance_out) }}" width="150px" alt="">
                    </td>
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
</html>