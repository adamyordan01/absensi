<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendance.in');
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
            $attendances = Attendance::create([
                'user_id' => Auth::id(),
                'when' => $when,
                'in' => $localTime,
            ]);
        }
        return redirect()->back()->with('success', 'Selamat anda telah melakukan absensi masuk, Terima Kasih.');
    }
}
