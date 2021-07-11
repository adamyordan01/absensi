<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use PDF;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendance.in');
    }

    public function attendanceOut()
    {
        return view('attendance.out');
    }

    public function store(Request $request)
    {
        $timezone = "Asia/Jakarta";
        $date = new DateTime('now', new DateTimeZone($timezone));
        $when = $date->format('Y-m-d');
        $localTime = $date->format('H:i:s');

        $attendance = Attendance::where([
            ['user_id', '=', Auth::id()],
            ['when', '=', $when],
        ])->first();

        if ($attendance) {
            // dd("Sudah Ada woii");
            return redirect()->back()->with('error', 'Anda telah melakukan absensi masuk, Terima Kasih.');
        } elseif (!$attendance) {
            // dd("Belum ada woii, absen teross");
            // $folderPath = public_path('upload/');
            // $signature = $request->signature;

            $folderPath = 'upload/';
        
            $image_parts = explode(";base64,", $request->signed);
                
            $image_type_aux = explode("image/", $image_parts[0]);
            
            $image_type = $image_type_aux[1];
            
            $image_base64 = base64_decode($image_parts[1]);
            
            $file = $folderPath . uniqid() . '.'.$image_type;
            file_put_contents($file, $image_base64);

            $photoPath = 'photo/';

            $photo = $request->image;
            $photo_parts = explode(";base64,", $photo);
            $photo_type_aux = explode("image/", $photo_parts[0]);
            $photo_type = $photo_type_aux[1];
        
            $photo_base64 = base64_decode($photo_parts[1]);
            $fileName = uniqid() . '.' . $photo_type;
        
            $photoFile = $photoPath . $fileName;
            file_put_contents($photoFile, $photo_base64);

            $attendances = Attendance::create([
                'user_id' => Auth::id(),
                'when' => $when,
                'in' => $localTime,
                'attendance_in' => $file,
                'photo_in' => $photoFile,
            ]);
        }
        return redirect()->back()->with('success', 'Selamat anda telah melakukan absensi masuk, Terima Kasih.');
    }

    public function updateAttendanceOut(Request $request)
    {
        $timezone = "Asia/Jakarta";
        $date = new DateTime('now', new DateTimeZone($timezone));
        $when = $date->format('Y-m-d');
        $localTime = $date->format('H:i:s');

        $attendance = Attendance::where([
            ['user_id', '=', Auth::id()],
            ['when', '=', $when],
        ])->first(); 
        
        
        if ($attendance['out'] == "" && $attendance['in'] != "") {
        $folderPath = 'upload/';
        
        $image_parts = explode(";base64,", $request->signed);
            
        $image_type_aux = explode("image/", $image_parts[0]);
        
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        
        $file = $folderPath . uniqid() . '.'.$image_type;
        file_put_contents($file, $image_base64);
       
        $photo = $request->image;
        $photo_parts = explode(";base64,", $photo);
        $photo_type_aux = explode("image/", $photo_parts[0]);
        $photo_type = $photo_type_aux[1];
    
        $photo_base64 = base64_decode($photo_parts[1]);
        $fileName = uniqid() . '.' . $photo_type;
    
        $photoFile = $folderPath . $fileName;
        file_put_contents($photoFile, $photo_base64);

        // $attendances = Attendance::create([
        //     'user_id' => Auth::id(),
        //     'when' => $when,
        //     'in' => $localTime,
        //     'attendance_in' => $file,
        //     'photo_in' => $photoFile,
        // ]);


            $data = [
                'out' => $localTime,
                'total' => date('H:i:s', strtotime($localTime) - strtotime($attendance->in)),
                'attendance_out' => $file,
                'photo_out' => $photoFile,
            ];
            $attendance->update($data);
            return redirect()->back()->with('success', 'Selamat anda telah melakukan absensi pulang, Terima Kasih.');
        } elseif ($attendance['in'] == "") {
            return redirect()->back()->with('error', 'Silahkan lakukan absensi masuk dahulu, Terima Kasih.');
        } else {
            return redirect()->back()->with('error', 'Anda telah melakukan absensi masuk, Terima Kasih.');
        }
    }

    public function annotation()
    {
        $leaves = Leave::latest()->where('user_id', '=', Auth::id())->simplePaginate(10);

        return view('attendance.annotation-index', [
            'leaves' => $leaves
        ]);
    }

    public function annotationCreate()
    {
        return view('attendance.annotation-create');
    }

    public function annotationStore(Request $request)
    {
        $timezone = "Asia/Jakarta";
        $date = new DateTime('now', new DateTimeZone($timezone));
        $when = $date->format('Y-m-d');
        // $localTime = $date->format('H:i:s');

        $leave = Leave::where([
            ['user_id', '=', Auth::id()],
            ['when', '=', $when],
        ])->first();

        if ($leave) {
            return redirect()->route('annotation')->with('error', 'Anda telah melakukan izin untuk hari ini, Silahkan tunggu konfirmasi dari Kepala Kantor, Terima Kasih.');
        } elseif (!$leave) {
            $this->validate($request, [
                'annotation' => 'required'
            ]);
    
            Leave::create([
                'user_id' => Auth::id(),
                'leave' => $request->leave,
                'annotation' => $request->annotation,
                'status' => 'pending',
                'when' => $when,
            ]);
            
            return redirect()->route('annotation')->with('success', 'Anda berhasil membuat permohonan izin, silahkan tunggu konfirmasi dari Kepala Kantor, Terima Kasih.');
        }
    }

    public function attendanceReport()
    {
        //INISIASI 30 HARI RANGE SAAT INI JIKA HALAMAN PERTAMA KALI DI-LOAD
        //KITA GUNAKAN STARTOFMONTH UNTUK MENGAMBIL TANGGAL 1
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');

        //DAN ENDOFMONTH UNTUK MENGAMBIL TANGGAL TERAKHIR DIBULAN YANG BERLAKU SAAT INI
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
        if (request()->date != '') {
            $date = explode(' - ' , request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
        $attendances = Attendance::where('user_id', '=', Auth::id())->with(['user'])->whereBetween('created_at', [$start, $end])->get();

        // Kemudian load view
        return view('attendance.report', [
            'attendances' => $attendances,
        ]);
    }

    public function attendanceReportPdf($daterange)
    {
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END

        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
        $attendances = Attendance::where('user_id', '=', Auth::id())->with(['user'])->whereBetween('created_at', [$start, $end])->get();

        //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
        $pdf = PDF::loadView('attendance.report_pdf', [
            'date' => $date,
            'attendances' => $attendances,
        ]);

        // Generate Pdf nya
        return $pdf->stream();
    }

    public function attendanceReportAdmin()
    {
        //INISIASI 30 HARI RANGE SAAT INI JIKA HALAMAN PERTAMA KALI DI-LOAD
        //KITA GUNAKAN STARTOFMONTH UNTUK MENGAMBIL TANGGAL 1
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');

        //DAN ENDOFMONTH UNTUK MENGAMBIL TANGGAL TERAKHIR DIBULAN YANG BERLAKU SAAT INI
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
        if (request()->date != '') {
            $date = explode(' - ' , request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
        $attendances = Attendance::with(['user'])->whereBetween('created_at', [$start, $end])->get();

        // Kemudian load view
        return view('attendance.report_admin', [
            'attendances' => $attendances,
        ]);
    }

    public function attendanceReportAdminPdf($daterange)
    {
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END

        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
        $attendances = Attendance::with(['user'])->whereBetween('created_at', [$start, $end])->get();

        //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
        $pdf = PDF::loadView('attendance.report_admin_pdf', [
            'date' => $date,
            'attendances' => $attendances,
        ]);

        // Generate Pdf nya
        return $pdf->stream();
    }

    public function attendancePrint($daterange)
    {
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END

        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
        $attendances = Attendance::with(['user'])->whereBetween('created_at', [$start, $end])->get();

        //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
        return view('attendance.print', [
            'date' => $date,
            'attendances' => $attendances,
        ]);







        // //INISIASI 30 HARI RANGE SAAT INI JIKA HALAMAN PERTAMA KALI DI-LOAD
        // //KITA GUNAKAN STARTOFMONTH UNTUK MENGAMBIL TANGGAL 1
        // $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');

        // //DAN ENDOFMONTH UNTUK MENGAMBIL TANGGAL TERAKHIR DIBULAN YANG BERLAKU SAAT INI
        // $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        // //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
        // if (request()->date != '') {
        //     $date = explode(' - ' , request()->date);
        //     $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        //     $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        // }

        // //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
        // $attendances = Attendance::with(['user'])->whereBetween('created_at', [$start, $end])->get();

        // // Kemudian load view
        // return view('attendance.print', [
        //     'attendances' => $attendances,
        // ]);
    }

    public function attendanceUserPrint($daterange)
    {
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END

        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
        $attendances = Attendance::where('user_id', '=', Auth::id())->with(['user'])->whereBetween('created_at', [$start, $end])->get();

        //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
        return view('attendance.print', [
            'date' => $date,
            'attendances' => $attendances,
        ]);

    }
}
