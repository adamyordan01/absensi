<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\User;
use App\Models\Leave;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::latest()->simplePaginate(10);
        // $users = User::get();
        
        return view('leaves.index', [
            'leaves' => $leaves,
            // 'users' => $users,

        ]);
    }

    public function update(Request $request, $id)
    {
        $leave = new Leave;
            
        $leave = Leave::find($id);

        // $leave->update([
        //     'status' => $request->status,
        // ]);

        $timezone = "Asia/Jakarta";
        $date = new DateTime('now', new DateTimeZone($timezone));
        $when = $date->format('Y-m-d');
        $localTime = $date->format('H:i:s');

        $user_id = Leave::find($id);

        $attendances = Attendance::where([
            ['user_id', '=', $leave->user_id],
            ['when', '=', $when],
        ])->first();

        if ($attendances) {
            return redirect()->back()->with('error', 'Status izin tidak dapat diubah.');
        } elseif (!$attendances) {             
            
            // $leave = Leave::find($id);

            $leave->update([
                'status' => $request->status,
            ]);

            $attend = new Attendance;
            $attend->user_id = $leave->user_id;
            $attend->annotation = $leave->status;
            $attend->when = $leave->when;
            $attend->in = $localTime;
            $attend->out = $localTime;
            $attend->total = date('H:i:s', strtotime($localTime) - strtotime($localTime));

            $attend->save();

            
            
            
            return redirect()->back()->with('success', 'Persetujuan Cuti berhasil diubah.');
        } 

    }
}
