<?php

namespace App\Http\Controllers;

use App\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=Pendidikan::all();
        return view('pages.pendidikan.index',compact('data'));
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
        //
        $validateData=$request->validate([
            'nama_pendidikan'=>'required|unique:pendidikans'
        ]);
        Pendidikan::create($validateData);
        return redirect()->route('pendidikan.index')->with([
            'css'=>'alert alert-success',
            'status'=>"Data Pendidikan {$request->nama_pendidikan} Berhasil Ditambah ",
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function show(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendidikan $pendidikan)
    {
        //
        $validateData=$request->validate([
            'nama_pendidikan'=>'required|unique:pendidikans,nama_pendidikan,'.$pendidikan->id
        ]);
        $pendidikan->update($validateData);
        return redirect()->route('pendidikan.index')->with([
            'css'=>'alert alert-warning',
            'status'=>"Data Pendidikan {$request->nama_pendidikan} Berhasil Diubah ",
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendidikan $pendidikan)
    {
        //
        $pendidikan->delete();
        return redirect()->route('pendidikan.index')->with([
            'css'=>'alert alert-danger',
            'status'=>"Data Pendidikan {$pendidikan->nama_pendidikan} Berhasil Dihapus ",
            ]);
    }
}
