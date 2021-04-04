<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Division;
use App\Models\RankAndGroup;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        // $profile = User::find($id);
        $divisions = Division::get();
        $ranks = RankAndGroup::get();

        return view('users.profile', [
            'user' => $request->user(),
            'divisions' => $divisions,
            'ranks' => $ranks,
            // 'profile' => $profile
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {

        // $this->validate($request, [
        //     'photo' => 'mimes:png,jpg|size:1024',
        // ]);

        $profile = $request->user();
        $filename = $profile->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

            // maka upload file tersebut
            $file->storeAs('public/pegawai', $filename);


            // hapus file lama pada storage
            \File::delete(storage_path('app/public/pegawai/' . $profile->photo));
        }

        // $request->user()->update(
        //     $request->all()
        // );

        // Update field
        $profile->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'nip' => $request->nip,
            'rankandgroup_id' => $request->rankandgroup_id,
            'division_id' => $request->division_id,
            'photo' => $filename,
        ]);
        

        return redirect()->back()->with('success', 'Anda telah berhasil update profile.');
    }
}
