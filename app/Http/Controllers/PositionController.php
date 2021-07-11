<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::latest()->simplePaginate(10);

        return view('positions.index', [
            'positions' => $positions,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'position_name' => 'required'
        ]);

        Position::create([
            'position_name' => $request->position_name
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data jabatan.');
    }

    public function update(Request $request, $id)
    {
        $position = Position::find($id);

        $this->validate($request, [
            'position_name' => 'required'
        ]);

        $position->update([
            'position_name' => $request->position_name,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengubah data jabatan.');
    }

    public function destroy($id)
    {
        $position = Position::find($id);

        $position->delete();
        
        return redirect()->back()->with('success', 'Berhasil menghapus data jabatan.');
    }
}
