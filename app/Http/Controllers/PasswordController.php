<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('users.password');
    }

    public function update(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->get('password'))
        ]);
        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}
