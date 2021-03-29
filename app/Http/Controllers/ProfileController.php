<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {

        return view('users.profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update(
            $request->all()
        );

        return redirect()->back()->with('success', 'Anda telah berhasil update profile.');
    }
}
