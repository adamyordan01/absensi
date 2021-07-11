<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('level', '!=', 'admin')->latest()->simplePaginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Anda Berhasil mengubah status user');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('success', 'Anda telah menghapus user tersebut.');
    }
    
}
