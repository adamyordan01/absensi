<?php

namespace App\Http\Controllers;

use App\Models\RankAndGroup;
use Illuminate\Http\Request;

class RankAndGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ranks = RankAndGroup::get();

        return view('rankandgroups.index', [
            'ranks' => $ranks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'group' => 'required',
            'rank' => 'required'
        ]);

        RankAndGroup::create($request->except('_token'));

        return redirect()->back()->with('success', 'Data Pangkat dan Golongan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rank = RankAndGroup::find($id);

        $this->validate($request, [
            'group' => 'required',
            'rank' => 'required',
        ]);

        $rank->update([
            'group' => $request->group,
            'rank' => $request->rank,
        ]);

        return redirect()->back()->with('success', 'Data Pangkat dan Golongan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rank = RankAndGroup::find($id);

        $rank->delete();

        return redirect()->back()->with('success', 'Data Pangakat dan Golongan Berhasil dihapus.');
    }
}
